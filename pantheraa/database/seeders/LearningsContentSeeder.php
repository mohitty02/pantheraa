<?php

namespace Database\Seeders;

use App\Models\Learning;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LearningsContentSeeder extends Seeder
{
    public function run(): void
    {
        // ---- Admin user (change the password after first login) ----
        User::updateOrCreate(
            ['email' => 'admin@pantheraa.space'],
            ['name' => 'Pantheraa Admin', 'password' => Hash::make('panthera123')]
        );

        // ---- Sample learnings ----
        $samples = [
            [
                'title'    => 'How RAG actually works (with code)',
                'category' => 'RAG',
                'tags'     => ['rag', 'embeddings', 'vector-db'],
                'excerpt'  => 'Retrieval-Augmented Generation grounds an LLM in your own data. The core loop in four steps — plus a tiny Python retriever.',
                'body'     => <<<'MD'
RAG (Retrieval-Augmented Generation) grounds an LLM in **your own data** instead of relying only on what it memorized during training.

## The core idea

1. **Embed** your documents into vectors.
2. **Retrieve** the most similar chunks for a query.
3. **Augment** the prompt with those chunks.
4. **Generate** an answer grounded in them.

Similarity is usually cosine similarity between embeddings:

$$ \text{sim}(a, b) = \frac{a \cdot b}{\lVert a \rVert \, \lVert b \rVert} $$

Here's a minimal retrieval loop in Python:

```python
import numpy as np

def cosine(a, b):
    return a @ b / (np.linalg.norm(a) * np.linalg.norm(b))

def retrieve(query_vec, docs, k=3):
    scored = [(cosine(query_vec, d["vec"]), d) for d in docs]
    scored.sort(key=lambda x: x[0], reverse=True)
    return [d for _, d in scored[:k]]
```

The retrieved chunks get stuffed into the context window before generation. Simple — but it changes everything.
MD,
            ],
            [
                'title'    => 'The math behind transformer attention',
                'category' => 'LLMs',
                'tags'     => ['transformers', 'attention', 'math'],
                'excerpt'  => 'Scaled dot-product attention in one formula, why the √dₖ scaling matters, and a tiny PyTorch sketch.',
                'body'     => <<<'MD'
The heart of a transformer is **scaled dot-product attention**. Given queries $Q$, keys $K$ and values $V$:

$$ \text{Attention}(Q, K, V) = \text{softmax}\!\left( \frac{QK^\top}{\sqrt{d_k}} \right) V $$

The $\sqrt{d_k}$ scaling stops the dot products from growing too large, which would push softmax into regions with vanishing gradients.

Softmax for a vector $z$ is:

$$ \sigma(z)_i = \frac{e^{z_i}}{\sum_j e^{z_j}} $$

A tiny PyTorch sketch:

```python
import torch
import torch.nn.functional as F

def attention(q, k, v):
    d_k = q.size(-1)
    scores = q @ k.transpose(-2, -1) / d_k ** 0.5
    weights = F.softmax(scores, dim=-1)
    return weights @ v
```

Once you see attention as a soft, differentiable lookup table, the rest of the architecture clicks into place.
MD,
            ],
            [
                'title'    => 'What actually mattered in AI this week',
                'category' => 'AI News',
                'tags'     => ['ai-news', 'agents'],
                'excerpt'  => 'Longer context, on-device models and dependable agents — the signals worth paying attention to.',
                'body'     => <<<'MD'
Every week the frontier moves. Here's what actually mattered to me this week — and why.

> The best way to keep up is not to read everything. It's to **build** something with each new capability.

- **Longer context windows** are quietly changing how we design RAG.
- **On-device models** are getting genuinely useful for private workloads.
- **Agents** are moving from flashy demos to dependable workflows.

I'll keep sharing the experiments here as I run them. 🐾
MD,
            ],
        ];

        foreach ($samples as $i => $data) {
            Learning::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($data['title'])],
                array_merge($data, [
                    'status'       => 'published',
                    'published_at' => now()->subDays($i),
                ])
            );
        }
    }
}
