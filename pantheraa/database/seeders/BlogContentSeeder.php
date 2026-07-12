<?php

namespace Database\Seeders;

use App\Models\Learning;
use App\Models\LearningCategory;
use Illuminate\Database\Seeder;

/**
 * Buyer-intent blog content. Every post is written answer-first (so Google and
 * AI engines can lift it into an answer), targets a long-tail keyword people
 * search *before they hire*, and links internally to the matching service page.
 */
class BlogContentSeeder extends Seeder
{
    public function run(): void
    {
        $cats = [
            ['slug' => 'web-development', 'name' => 'Web Development', 'description' => 'Websites, pricing, performance and what to look for before you hire.'],
            ['slug' => 'software',        'name' => 'Software & Apps',  'description' => 'Custom software, mobile apps and automation for growing businesses.'],
            ['slug' => 'seo',             'name' => 'SEO',              'description' => 'How search really works — and how to rank without gimmicks.'],
            ['slug' => 'google-ads',      'name' => 'Google Ads',       'description' => 'Budgets, bidding and getting leads that actually convert.'],
            ['slug' => 'meta-ads',        'name' => 'Meta Ads',         'description' => 'Facebook & Instagram advertising that stops the scroll.'],
            ['slug' => 'gmb',             'name' => 'Google Business Profile', 'description' => 'Local SEO and ranking in the Google map pack.'],
            ['slug' => 'aio',             'name' => 'AIO / AI Search',  'description' => 'Getting your brand cited by ChatGPT, Gemini and AI Overviews.'],
        ];
        foreach ($cats as $i => $c) {
            LearningCategory::updateOrCreate(['slug' => $c['slug']], $c + ['sort' => 10 + $i, 'is_active' => true]);
        }
        $id = fn (string $slug) => LearningCategory::where('slug', $slug)->value('id');

        $posts = [

            // ────────────────────────────────────────────────────────────
            [
                'title' => 'Website Development Cost in India (2026): An Honest Price Breakdown',
                'cat' => 'web-development',
                'days' => 42,
                'tags' => ['website cost', 'web development', 'pricing'],
                'meta_title' => 'Website Development Cost in India 2026 — Real Pricing Breakdown',
                'meta_description' => 'What a website actually costs in India in 2026: real price ranges for business, e-commerce and custom sites, what drives the cost up, and how to avoid overpaying.',
                'excerpt' => 'A professional business website in India costs roughly ₹25,000–₹1,50,000+. Here is exactly what drives that number — and where agencies quietly overcharge.',
                'body' => <<<'MD'
**Short answer:** a professional business website in India costs roughly **₹25,000 to ₹1,50,000+** in 2026. A basic brochure site sits at the low end, an e-commerce store in the middle, and custom-built platforms above it. Anyone quoting ₹5,000 is selling you a template you will replace within a year.

Below is the honest breakdown — what you get at each price, what actually drives the cost, and the questions that save you from overpaying.

## Website cost in India by type

| Type of website | Realistic price (2026) | Timeline |
|---|---|---|
| Basic business / brochure site (5–8 pages) | ₹25,000 – ₹60,000 | 2–3 weeks |
| Professional site + blog + CMS | ₹60,000 – ₹1,20,000 | 3–5 weeks |
| E-commerce store | ₹80,000 – ₹2,50,000 | 4–8 weeks |
| Custom web app / platform | ₹2,00,000+ | 8 weeks+ |

Prices vary with the agency's experience and the complexity of what you need — but if a quote is far outside these ranges in either direction, ask why.

## What actually drives the price up

1. **Number of unique page designs.** Ten pages using the same template is cheap. Ten *individually designed* pages is not.
2. **Custom functionality.** Booking systems, payment gateways, dashboards, logins and integrations are where hours go.
3. **Content.** If you have no copy, photos or product data, someone has to create it — and that is real work.
4. **Performance and SEO.** A site engineered to load in under a second and rank on Google takes more skill than one that merely looks nice.
5. **Ongoing support.** Hosting, security updates and changes after launch. Ask whether these are included or billed separately.

## Where people overpay

- **Paying for "design" and getting a template.** Ask to see the design *before* development starts.
- **Getting locked into a proprietary CMS** you can never leave without rebuilding.
- **Buying pages you do not need.** Most businesses convert on 5–6 well-written pages, not 30 thin ones.
- **Skipping SEO at build time** and paying to retro-fit it later, which costs far more.

## Where people underpay (and regret it)

A ₹8,000 website is almost always a template with your logo dropped in. It will be slow, it will not rank, it will not be mobile-optimised, and you will not be able to edit it. You will rebuild it within a year — so the "cheap" site actually cost you the price of two.

## What a good quote should include

- Custom, conversion-focused design (not a stock template)
- Mobile-first build and sub-second load times
- A CMS you can edit yourself
- On-page SEO, schema, sitemap, Search Console and analytics set up
- A warranty period after launch

If any of those are missing, the quote is not comparable — no matter how low the number is.

## FAQ

**Does an expensive website mean more customers?**
No — but a *well-built* one does. What converts is speed, clarity, trust signals and a clear call to action. A beautiful site that loads in five seconds will lose to a plain one that loads in one.

**Should I use WordPress or a custom build?**
WordPress is excellent for content-led sites. Custom (Laravel, headless) makes sense when you need real functionality, speed or a platform to grow. A good agency recommends the cheaper option when it is the right one.

**How long does it take?**
Two to four weeks for a standard business site; four to eight for e-commerce.

---

We build [conversion-focused websites](/services/website-development) that are fast, SEO-ready and editable by you — with a fixed quote after a free scoping call, so there are no surprises.

**[Get a free quote →](/contact)**
MD,
            ],

            // ────────────────────────────────────────────────────────────
            [
                'title' => 'How to Rank in the Google Map Pack: A GMB Optimization Guide',
                'cat' => 'gmb',
                'days' => 38,
                'tags' => ['gmb', 'local seo', 'google business profile'],
                'meta_title' => 'How to Rank in the Google Map Pack — GMB Optimization Guide 2026',
                'meta_description' => 'Rank your Google Business Profile in the local 3-pack: the ranking factors that actually matter, a step-by-step optimization checklist, and realistic timelines.',
                'excerpt' => 'The Google map pack is the fastest source of leads for most local businesses. Here is exactly how ranking works — and the checklist to get in.',
                'body' => <<<'MD'
**Short answer:** to rank in the Google map pack you need three things — a **fully completed and verified Google Business Profile**, **consistent NAP** (name, address, phone) across the web, and a **steady flow of genuine reviews**. Most businesses can enter the local 3-pack within **3–8 weeks** of doing this properly.

The map pack — those three businesses Google shows above the normal results — is the fastest, cheapest lead source most local businesses ever get. And unlike traditional SEO, you are not competing with the whole internet. You are competing with the few businesses near you.

## How Google actually ranks the map pack

Google weighs three things:

1. **Relevance** — does your profile clearly say you do this service?
2. **Distance** — how close are you to the searcher?
3. **Prominence** — how well-known and trusted are you (reviews, citations, links)?

You cannot change distance. You have full control over relevance and prominence — which is exactly where most businesses leave money on the table.

## The optimization checklist

**1. Claim and verify the profile.** Nothing works until you are verified. Video verification is now the most common method — record your signage, workspace and a business document in one unbroken clip.

**2. Choose the right primary category.** This is the single highest-impact field on your profile. Pick the most specific category that matches your money service, then add secondary categories for everything else you do.

**3. Fill in *every* field.** Services, service areas, hours, attributes, description, opening date. A 100% complete profile outranks an 80% complete one, all else being equal.

**4. Add real photos — and keep adding them.** Ten-plus photos of your team, workspace and work. Profiles with fresh photos get materially more views and clicks.

**5. List your services individually.** Do not write "digital marketing". Add each service as its own entry with its own description. Each one is a chance to match a search.

**6. Get reviews — consistently.** Review *velocity* (a steady trickle) beats a sudden burst. Ask every happy customer, make it one click, and **reply to every single review**. Google reads your replies.

**7. Post weekly.** Offers, updates, new work. An active profile signals a live business.

**8. Keep NAP consistent everywhere.** Your name, address and phone must be **identical** on your website, GMB and every directory. Inconsistency is one of the most common reasons local rankings stall.

## Service-area businesses (no shop or office)

You can still rank. Choose "I deliver goods and services to my customers", hide your address, and list the areas you serve. Set this up correctly and verification goes through without issues.

## Realistic timeline

| Stage | Typical time |
|---|---|
| Verification | 3–14 days |
| Profile fully optimized | 1 week |
| First map pack appearances | 3–8 weeks |
| Competitive city + category | 3–6 months (needs reviews) |

## FAQ

**How many reviews do I need to rank?**
There is no magic number. What matters is being competitive with the businesses currently ranking — and getting reviews *steadily* rather than all at once.

**Do keywords in reviews help?**
Yes, when they occur naturally. Never script them. Instead ask, "Could you mention which service we helped you with?"

**Can I rank in a city I am not located in?**
It is hard for the map pack — distance is a real factor. For other cities, target organic rankings with dedicated pages instead.

---

We handle [Google Business Profile setup, verification and optimization](/services/google-business-profile) — including the weekly posts and review system that keep you in the pack.

**[Get a free GMB audit →](/contact)**
MD,
            ],

            // ────────────────────────────────────────────────────────────
            [
                'title' => 'SEO vs Google Ads: Which Should You Invest In First?',
                'cat' => 'seo',
                'days' => 34,
                'tags' => ['seo', 'google ads', 'strategy'],
                'meta_title' => 'SEO vs Google Ads — Which Should You Do First? (Honest Comparison)',
                'meta_description' => 'SEO or Google Ads first? An honest comparison of cost, speed, and ROI — plus the simple rule that tells you which one your business should start with.',
                'excerpt' => 'Ads give you leads tomorrow. SEO gives you leads forever. Here is the honest way to decide which to start with — and why most businesses should do both.',
                'body' => <<<'MD'
**Short answer:** if you need leads **this month**, start with **Google Ads**. If you can wait 3–6 months for a channel that keeps paying after you stop spending, invest in **SEO**. Most businesses that can afford it should run ads for immediate cash flow while SEO compounds in the background — because they solve different problems.

## The honest comparison

| | Google Ads | SEO |
|---|---|---|
| First leads | Days | 2–6 months |
| Cost behaviour | Stops when you stop paying | Compounds; cost per lead falls over time |
| Predictability | High — turn it up or down | Lower, but far more durable |
| Best for | Immediate leads, testing offers | Long-term, defensible growth |
| Risk | Burning budget on bad targeting | Slow start; needs patience |

## Start with Google Ads if…

- You need enquiries **now** (new business, cash-flow pressure)
- You are **testing an offer** and need fast market feedback
- Your service is urgent (people search and buy the same day)
- You have a budget of at least ₹30,000/month in ad spend for meaningful data

The advantage nobody talks about: ads give you **keyword data in weeks** that would take SEO months to learn. You find out exactly which search terms produce real customers — then you build SEO around those proven keywords instead of guessing.

## Start with SEO if…

- Your margins cannot support paid clicks
- Your industry has expensive clicks (legal, finance, B2B software)
- You are building a long-term brand rather than chasing quick sales
- You already have some traffic and authority to build on

## The rule that actually decides it

> **Can you afford to wait 4 months for leads?**
> If **no** → ads first.
> If **yes** → SEO first, and add ads when cash flow allows.

## Why the smartest play is both

Ads and SEO make each other better:

- Ads reveal which keywords convert → SEO targets those first
- SEO lowers your blended cost per lead over time → ads become more profitable
- Appearing in **both** the ad slot and the organic result significantly increases the chance of the click

A common, sensible split for a growing business: 70% of budget on ads for the first quarter, gradually shifting to 50/50 as organic starts producing.

## What about GMB?

If you serve customers locally, [Google Business Profile](/services/google-business-profile) usually beats both on speed-to-lead — and it is free. Do that first, always.

## FAQ

**Is SEO cheaper than Google Ads?**
Long term, almost always. Short term, no — SEO costs money for months before it returns anything. Ads return from week one.

**Can I do SEO myself?**
The basics, yes: good content, fast site, clear structure. Technical SEO and link building are where most DIY attempts stall.

**How long until SEO beats ads on ROI?**
Typically month 6–12, depending on competition.

---

We run [Google Ads](/services/google-ads) and [SEO](/services/seo) — and we will tell you honestly which one your budget should go to first.

**[Get a free strategy audit →](/contact)**
MD,
            ],

            // ────────────────────────────────────────────────────────────
            [
                'title' => 'What is AIO? How to Get Your Brand Cited by ChatGPT and Google AI',
                'cat' => 'aio',
                'days' => 30,
                'tags' => ['aio', 'aeo', 'geo', 'ai search'],
                'meta_title' => 'What is AIO (AI Optimization)? Get Cited by ChatGPT & Google AI',
                'meta_description' => 'AIO explained: how AI Optimization (AEO + GEO) gets your brand recommended inside ChatGPT, Gemini, Perplexity and Google AI Overviews — and how to start today.',
                'excerpt' => 'Your customers have started asking AI instead of Googling. AI recommends a handful of brands — not ten links. Here is how to become one of them.',
                'body' => <<<'MD'
**Short answer:** **AIO (AI Optimization)** is the practice of structuring your brand, content and data so that AI systems — ChatGPT, Gemini, Perplexity and Google AI Overviews — **cite and recommend you** when someone asks about your category. It combines **AEO** (Answer Engine Optimization, getting into direct answers) and **GEO** (Generative Engine Optimization, getting quoted inside AI-generated responses).

Traditional SEO competes for ten blue links. AI gives you **one answer, naming two or three brands**. If you are not one of them, you are invisible — no matter how well you rank on page one.

## Why this matters right now

A growing share of buyers now start with "which is the best X for Y?" typed into an AI tool. Those users arrive already convinced, because a machine they trust recommended you. It is the highest-intent traffic on the internet.

And here is the part most agencies have not noticed: **almost nobody is competing for it yet.** This is the same window SEO had around 2010.

## How AI decides who to cite

LLMs and AI search do not "rank" pages the way Google does. They pull from:

1. **Structured data (schema)** — machine-readable facts about who you are and what you do.
2. **Clear, citable content** — short, direct, factual passages that are easy to lift into an answer.
3. **Entity consistency** — your brand described the same way across your site, directories, LinkedIn, Wikipedia-adjacent sources.
4. **Third-party mentions** — what *other* trusted sites say about you (this is heavily weighted).
5. **E-E-A-T signals** — evidence of real experience, expertise and authority.

## The AIO playbook (what actually works)

**1. Write answer-first.** Put the direct answer in the first two sentences, before any preamble. AI lifts the opening. (This post does it — that is not an accident.)

**2. Add real schema.** Organization, Service, FAQPage, Article, Breadcrumb. Machines cannot infer what you refuse to declare.

**3. Build a FAQ layer.** Every question your buyers ask, answered plainly in 40–60 words. This is the single easiest way to get quoted.

**4. Be specific and factual.** "Websites in India cost ₹25,000–₹1,50,000" gets cited. "Prices vary based on requirements" never does.

**5. Get mentioned elsewhere.** Directories, guest posts, podcasts, Reddit, Quora, LinkedIn. AI models weigh what others say about you more than what you say about yourself.

**6. Keep your entity consistent.** Same brand name, same description, same category, everywhere.

**7. Monitor your citations.** Actually ask ChatGPT, Gemini and Perplexity the questions your buyers ask. See who gets named. That is your real ranking report.

## AIO vs AEO vs GEO — the difference

| Term | What it means |
|---|---|
| **AEO** | Getting into direct answers, featured snippets and voice results |
| **GEO** | Getting quoted inside AI-generated answers (ChatGPT, Gemini, AI Overviews) |
| **AIO** | The umbrella practice covering both |

## FAQ

**Can you really influence what ChatGPT says?**
Yes — meaningfully. Not by hacking the model, but by supplying the structured, citable, corroborated information it relies on. It is engineering, not magic.

**Does AIO replace SEO?**
No. It builds on it. A site with strong SEO fundamentals is far easier to optimize for AI — but SEO alone will not get you cited.

**How long does AIO take?**
Faster than SEO, typically 4–10 weeks — mainly because so few competitors are doing it.

---

We do [AI Search Optimization (AIO)](/services/ai-search-optimization) — schema and entity work, answer-first content, and real citation monitoring across ChatGPT, Gemini and AI Overviews.

**[Check if AI recommends you →](/contact)**
MD,
            ],

            // ────────────────────────────────────────────────────────────
            [
                'title' => 'How Much Do Google Ads Cost in India? A Budget Guide by Industry',
                'cat' => 'google-ads',
                'days' => 26,
                'tags' => ['google ads', 'ppc', 'budget'],
                'meta_title' => 'Google Ads Cost in India (2026) — Budget Guide by Industry',
                'meta_description' => 'What Google Ads really cost in India: typical cost-per-click by industry, the minimum monthly budget that works, and how to lower your cost per lead.',
                'excerpt' => 'Most Indian businesses need ₹30,000–₹50,000/month in ad spend for Google Ads to work. Here is why — and what your cost per lead should look like.',
                'body' => <<<'MD'
**Short answer:** for most Indian service businesses, a working Google Ads budget starts at **₹30,000–₹50,000 per month** in ad spend. Below that, you rarely gather enough conversion data for the algorithm to optimize, and results stay random. Typical costs per click in India range from **₹8 to ₹150+**, depending on the industry.

## Typical cost per click in India

| Industry | Typical CPC |
|---|---|
| Local services (salon, repairs, tuition) | ₹8 – ₹30 |
| Healthcare / clinics | ₹25 – ₹80 |
| Real estate | ₹40 – ₹150 |
| Education / coaching | ₹30 – ₹100 |
| B2B software / IT services | ₹50 – ₹200 |
| Legal / finance | ₹80 – ₹250 |

These are ranges, not promises. Your actual CPC depends on competition, keyword intent, Quality Score and location.

## The maths that decides your budget

Work backwards from a lead, not forwards from a budget:

```
Clicks needed = Leads you want ÷ Landing page conversion rate
Budget        = Clicks needed × Cost per click
```

**Example:** you want 20 leads. Your landing page converts at 5%. So you need 400 clicks. At ₹60 CPC, that is **₹24,000/month** — and that assumes your page actually converts at 5%.

This is why the landing page matters as much as the ads. Doubling conversion rate from 3% to 6% halves your cost per lead — without touching your budget.

## Why very small budgets usually fail

Google's automated bidding needs conversion data to learn. On ₹10,000/month with a ₹60 CPC, you get ~165 clicks — perhaps 5–8 conversions. That is not enough signal. The algorithm never gets out of learning mode, and your results stay noisy and expensive.

If ₹30,000/month is out of reach, put the money into [Google Business Profile](/services/google-business-profile) and [SEO](/services/seo) instead. That is honest advice, and it will serve you better.

## Where the money leaks

1. **No negative keywords.** You are paying for "free", "jobs", "salary", "course" searches.
2. **Broad match without supervision.** Google will happily spend on loosely related terms.
3. **Sending traffic to the homepage.** Always send ads to a dedicated, matching landing page.
4. **No conversion tracking.** If you cannot see which keyword produced the enquiry, you are optimizing blind.
5. **Ignoring Quality Score.** Better relevance literally lowers your cost per click.

## What a healthy account looks like

- Cost per lead **below** the profit on one sale (obviously — but few actually check)
- Conversion tracking firing correctly for calls, forms **and** WhatsApp
- A growing negative-keyword list
- Landing pages that match the ad promise word for word
- Search-term reports reviewed weekly, not monthly

## FAQ

**How soon will I get leads?**
Usually within 1–2 weeks of launch. Month one is data collection; from month two we push the cost per lead down.

**Is Performance Max worth it?**
It can be excellent — but only once conversion tracking is solid. Run it *after* Search is working, never instead of it.

**Should I run ads and SEO together?**
Ideally yes. Ads reveal which keywords convert; SEO then targets those proven keywords for free traffic.

---

We manage [Google Ads](/services/google-ads) with proper tracking, tight negatives and landing pages built to convert — so you know exactly what every rupee returned.

**[Get a free ad account audit →](/contact)**
MD,
            ],

            // ────────────────────────────────────────────────────────────
            [
                'title' => 'How to Choose a Website Development Company in India: 10 Questions to Ask',
                'cat' => 'web-development',
                'days' => 22,
                'tags' => ['web development', 'hiring', 'agency'],
                'meta_title' => 'How to Choose a Website Development Company in India (10 Questions)',
                'meta_description' => 'The 10 questions that separate a good website development company from an expensive mistake — plus the red flags that should end the conversation.',
                'excerpt' => 'Most bad website projects were predictable at the first meeting. These ten questions surface the truth before you pay anyone.',
                'body' => <<<'MD'
**Short answer:** ask to see the **design before development starts**, confirm you will **own the code and hosting**, insist on a **fixed scope with a written timeline**, and check that **SEO and speed are included** — not sold as an upsell later. Those four answers eliminate most bad agencies immediately.

Here are the ten questions worth asking, and what a good answer sounds like.

## The 10 questions

**1. Will I see the design before you start building?**
*Good answer:* yes, you approve designs first. If they go straight to development, you are getting a template.

**2. Who owns the code, domain and hosting?**
*Good answer:* you do, entirely. Walk away from anyone who keeps your domain or hosts you on a platform you cannot leave.

**3. Can I edit the content myself after launch?**
*Good answer:* yes, through an admin panel, with training included. If every text change means an invoice, that is a business model — not a service.

**4. Is SEO included at build time?**
*Good answer:* yes — schema, sitemap, meta, clean structure, Search Console and analytics. Retro-fitting SEO later costs far more than building it in.

**5. What will the site score on Google PageSpeed?**
*Good answer:* they quote a target (85+ mobile) and mean it. Speed affects both rankings and conversions.

**6. What exactly is in scope — and what is not?**
*Good answer:* a written scope listing pages, features and revisions. Vague scope is how "small changes" become large invoices.

**7. Who writes the content?**
*Good answer:* clearly assigned to one side. Most delays on website projects are caused by content, not code.

**8. What happens after launch?**
*Good answer:* a defined warranty period, plus a clear maintenance option. Not silence.

**9. Can I speak to two recent clients?**
*Good answer:* yes, without hesitation. Then actually call them and ask about *communication*, not just the final product.

**10. Why this technology?**
*Good answer:* a reason tied to your needs. "Because it is what we always use" is not one.

## Red flags that should end the conversation

- Quotes given without asking a single question about your business
- "Unlimited pages" packages (they are templates)
- Promising a #1 Google ranking
- No written scope or timeline
- Advance payment above 50%
- Portfolio sites you cannot actually visit

## Green flags

- They ask *what a lead is worth to you* before quoting
- They talk about conversions, not just design
- They recommend the cheaper option when it genuinely fits
- They show you their process, not just their portfolio

## FAQ

**Freelancer or agency?**
A good freelancer is excellent value for a simple site. For anything with a deadline, ongoing support needs, or multiple skills (design + dev + SEO), an agency is usually the safer bet.

**Should I pick the cheapest quote?**
Compare what is *included*, not the headline number. The cheapest quote almost always excludes SEO, speed work, a CMS and support — which you will end up paying for anyway.

---

We build [websites](/services/website-development) with a fixed scope, a fixed quote, and SEO built in from day one — and you own everything.

**[Get a free scoping call →](/contact)**
MD,
            ],

            // ────────────────────────────────────────────────────────────
            [
                'title' => 'Custom Software vs Off-the-Shelf: What Does Your Business Actually Need?',
                'cat' => 'software',
                'days' => 18,
                'tags' => ['custom software', 'saas', 'automation'],
                'meta_title' => 'Custom Software vs Off-the-Shelf — Which Does Your Business Need?',
                'meta_description' => 'When custom software is worth it and when a ready-made tool wins. A practical decision framework, real costs, and the questions to ask before you build.',
                'excerpt' => 'Custom software is not automatically better — it is better in specific situations. Here is the simple test that tells you which side you are on.',
                'body' => <<<'MD'
**Short answer:** buy **off-the-shelf** when your process is standard and the tool is cheap relative to the pain. Build **custom** when the software touches how you actually make money, when you are paying for many tools that still do not fit, or when your workaround is a person doing manual work every day.

## The simple test

Ask one question: **is this process a competitive advantage, or just admin?**

- **Admin** (payroll, accounting, email) → buy a tool. Never build it.
- **Competitive advantage** (how you quote, dispatch, price, deliver) → custom is usually worth it.

Most businesses get this backwards: they buy a rigid tool for the thing that makes them special, then hire people to work around its limits.

## When off-the-shelf wins

- Your process is genuinely standard
- The tool costs less than a few thousand rupees a month
- You need it working next week
- You do not need it to talk to your other systems

## When custom wins

- You pay for 4–5 tools that still do not fit together
- Someone on your team spends hours a week copying data between systems
- The tool cannot do the one thing you actually need
- Your subscription costs are climbing with headcount
- You are building a product, not just running operations

## The cost comparison people get wrong

| | Off-the-shelf | Custom |
|---|---|---|
| Upfront | Low / free | Higher one-time build |
| Monthly | Per user, forever, rising | Hosting only |
| Fit | ~70% | ~100% |
| Hidden cost | Manual workarounds, staff time | Maintenance |

The number nobody calculates: **the salary cost of the workaround**. If two people spend an hour a day copying data between systems, that is roughly 500 hours a year. Price that honestly and custom software often pays for itself within the first year.

## What custom software should include

1. **Discovery first.** A good team maps your process before writing any code — because building the wrong thing quickly is still failure.
2. **A phased build.** Ship a usable v1, then improve. Never a twelve-month big bang.
3. **Documentation and training.** Software nobody uses is money burned.
4. **A clear support plan.** Software needs maintenance, exactly like a car.

## The hybrid answer (usually the right one)

Keep the boring standard tools. Build custom only for the layer that makes you money, and **integrate** it with what you already use via APIs. This is almost always the cheapest, fastest path — and it is what we recommend most often.

## FAQ

**How long does custom software take?**
A focused v1 typically takes 6–12 weeks. Anything promising a full platform in two weeks is selling you a template.

**Can AI reduce the cost?**
Yes — AI genuinely speeds up development and can replace whole features (chatbots, document processing, support triage). It does not remove the need to think carefully about your process.

**What if my requirements change?**
They will. That is exactly why phased delivery matters — you see working software early and steer it.

---

We build [custom software, apps and automations](/services/software-development) — starting with a discovery session that maps your process before a single line of code is written.

**[Book a free discovery call →](/contact)**
MD,
            ],

            // ────────────────────────────────────────────────────────────
            [
                'title' => 'Facebook Ads Not Working? 7 Reasons Meta Ads Fail (and How to Fix Them)',
                'cat' => 'meta-ads',
                'days' => 14,
                'tags' => ['meta ads', 'facebook ads', 'troubleshooting'],
                'meta_title' => 'Facebook Ads Not Working? 7 Reasons Meta Ads Fail — and the Fixes',
                'meta_description' => 'Meta ads burning money with no leads? The seven real reasons Facebook and Instagram ads fail — and exactly how to fix each one.',
                'excerpt' => 'If your Meta ads are not working, it is almost never the algorithm. It is one of these seven things — and six of them are fixable this week.',
                'body' => <<<'MD'
**Short answer:** when Facebook and Instagram ads fail, the cause is almost always one of three things — **weak creative**, **a broken offer**, or **broken tracking**. Targeting is rarely the problem people assume it is, because on Meta the creative *is* the targeting.

Here are the seven real reasons, in the order they usually cause damage.

## 1. Your creative does not stop the scroll

This is the number one cause, and it is not close. Meta shows your ad for roughly half a second before the thumb moves.

**Fix:** lead with a pattern interrupt in the first frame. Show the problem, not your logo. Test 3–5 genuinely different *angles* (not just colour swaps) every month. Video and raw, native-looking content usually beat polished corporate assets.

## 2. Your offer is not compelling

People do not scroll Instagram intending to buy. Meta is interruption marketing — you have to be worth interrupting for.

**Fix:** stop saying "contact us". Give a reason to act now: a free audit, a real discount, a genuinely useful guide, a free trial. The offer moves the needle far more than the targeting does.

## 3. Tracking is broken (so the algorithm is blind)

Since iOS privacy changes, browser-based Pixel tracking misses a large share of conversions. Meta cannot optimize toward outcomes it cannot see.

**Fix:** set up the **Conversions API (CAPI)** for server-side tracking alongside the Pixel. Verify your domain. Configure your priority events. This is unglamorous and it is often the single highest-impact fix.

## 4. You are optimizing for the wrong event

Optimizing for "Link Clicks" gets you clickers. Optimizing for "Leads" gets you leads. They are not the same people.

**Fix:** always optimize for the event closest to actual revenue that has enough volume (roughly 50 conversions per week per ad set for the algorithm to learn).

## 5. You kill ads too early

Meta needs time and data to exit its learning phase. Turning ads off after two days tells you nothing.

**Fix:** give an ad set at least 3–4 days and ~50 conversions before you judge it. Resist daily budget fiddling — every edit resets learning.

## 6. Your landing page does not match the ad

The ad promised a free audit. The page is a generic homepage. The visitor leaves.

**Fix:** one ad → one dedicated page → one action. Match the headline to the ad copy word for word. Load it in under two seconds.

## 7. No retargeting

Most people will not convert on the first touch, ever.

**Fix:** run a retargeting campaign to website visitors, video viewers and engagers. It is almost always your cheapest source of conversions — and the most commonly skipped.

## Diagnose it in five minutes

| Symptom | Most likely cause |
|---|---|
| Low reach / high CPM | Weak creative, small audience |
| Good clicks, no leads | Landing page or offer |
| Good leads, poor quality | Offer too broad; add qualification |
| Nothing at all | Tracking broken — check first |

## FAQ

**Do Meta ads work for B2B?**
Yes — with the right offer. Lead magnets and qualification questions filter out the noise. Meta is far cheaper than LinkedIn for the same person.

**How much budget do I need?**
Start at ₹20,000–₹30,000/month. Below that you cannot gather enough data to learn anything.

**How often should I change creative?**
Refresh every 2–4 weeks. Creative fatigue is real and shows up as rising CPM with falling CTR.

---

We run [Meta Ads](/services/meta-ads) with in-house creative, proper CAPI tracking and retargeting that actually pays.

**[Get a free ad account audit →](/contact)**
MD,
            ],

            // ────────────────────────────────────────────────────────────
            [
                'title' => 'How Long Does SEO Take to Show Results? An Honest Timeline',
                'cat' => 'seo',
                'days' => 9,
                'tags' => ['seo', 'timeline', 'expectations'],
                'meta_title' => 'How Long Does SEO Take to Show Results? (Honest 2026 Timeline)',
                'meta_description' => 'How long SEO really takes: a month-by-month timeline, what moves first, what to measure early, and why anyone promising #1 in 30 days is lying.',
                'excerpt' => 'SEO takes 4–6 months for competitive keywords and 6–10 weeks for long-tail. Here is the honest month-by-month timeline — and what to watch before rankings move.',
                'body' => <<<'MD'
**Short answer:** long-tail and low-competition keywords typically start moving in **6–10 weeks**. Competitive head terms usually take **4–6 months**, and in crowded industries, longer. Anyone promising a #1 ranking in 30 days is either lying or about to get your site penalised.

## The honest month-by-month timeline

| Month | What is happening | What you should see |
|---|---|---|
| **1** | Technical fixes, keyword research, on-page work | Crawl errors fixed, pages indexed. **No ranking change yet — this is normal.** |
| **2** | Content publishing begins, internal linking | Impressions rise in Search Console. Long-tail keywords appear on pages 3–5. |
| **3** | Content compounds, first links earned | First page-1 rankings on long-tail terms. Traffic starts to move. |
| **4–6** | Authority building, content depth | Mid-competition keywords reach page 1. Leads begin arriving. |
| **6–12** | Compounding | Head terms move. Cost per lead drops sharply. |

## Why it takes this long

1. **Google has to crawl and re-evaluate** your pages — that alone takes weeks.
2. **Trust is earned, not declared.** A new domain has no history, and Google is conservative with unknowns.
3. **Content needs to accumulate.** One page rarely ranks; a cluster of related pages does.
4. **Links take time.** Authority is the slowest input and the hardest to fake.

## What to measure *before* rankings move

This is the part that separates people who succeed at SEO from people who quit in month two. Rankings are a *lagging* indicator. Watch these instead:

- **Impressions** in Search Console (the earliest real signal — usually moves in weeks)
- **Number of keywords ranking anywhere in the top 100** (should climb steadily)
- **Pages indexed**
- **Average position** trending up, even from page 5 to page 3

If impressions and keyword count are climbing, SEO is working — even if traffic has not arrived yet.

## What makes it faster

- An **existing domain** with some history and links
- **Low-competition** and long-tail keywords targeted first
- A **technically clean, fast** site
- **Consistent publishing** (2+ quality pieces per week)
- Existing brand mentions and links

## What makes it slower

- A brand-new domain with zero authority
- Going straight for head terms ("seo company") instead of building up to them
- Thin, AI-spun content with no real substance
- Publishing once a month
- No links, ever

## The realistic plan for a new business

Do not choose. Run this in parallel:

1. **[Google Business Profile](/services/google-business-profile)** → leads in 3–8 weeks
2. **[Google Ads](/services/google-ads)** → leads within 2 weeks
3. **[SEO](/services/seo)** → compounding from month 3, dominant by month 12

Ads and GMB pay the bills while SEO builds the asset.

## FAQ

**Can SEO work in 30 days?**
For a very specific long-tail keyword on an established site, sometimes. As a general promise, no.

**Should I stop SEO if I see nothing in month 2?**
No — month 2 is exactly when nothing visible happens. Check impressions and indexed pages instead. If those are flat too, *then* something is wrong.

**Does SEO stop working if I pause it?**
Existing rankings decay slowly, but competitors keep publishing. You lose ground gradually, not instantly.

---

We do [SEO](/services/seo) with transparent monthly reporting on the leading indicators — so you can see it working before the rankings arrive.

**[Get a free SEO audit →](/contact)**
MD,
            ],

            // ────────────────────────────────────────────────────────────
            [
                'title' => 'Local SEO Checklist for Indian Businesses (2026)',
                'cat' => 'gmb',
                'days' => 4,
                'tags' => ['local seo', 'gmb', 'checklist'],
                'meta_title' => 'Local SEO Checklist for Indian Businesses (2026) — Free Guide',
                'meta_description' => 'A practical local SEO checklist for Indian businesses: GMB, NAP consistency, local citations, reviews, on-page signals and the mistakes that kill local rankings.',
                'excerpt' => 'A complete, no-fluff local SEO checklist — the exact steps that get Indian businesses into the map pack and onto page one locally.',
                'body' => <<<'MD'
**Short answer:** local SEO comes down to four things — a **fully optimized Google Business Profile**, **identical NAP** (name, address, phone) everywhere online, **local citations** on Indian directories, and **a steady flow of reviews**. Do those four properly and most businesses reach the map pack within 3–8 weeks.

Work through this checklist in order. It is deliberately sequenced by impact.

## 1. Google Business Profile (highest impact)

- [ ] Profile claimed and **verified**
- [ ] Correct **primary category** (the single most important field)
- [ ] Secondary categories added for every other service
- [ ] Every service listed **individually**, each with its own description
- [ ] Business description written with your main keyword naturally included
- [ ] 10+ real photos (team, workspace, work) — and added regularly
- [ ] Hours, attributes and service areas complete
- [ ] Weekly GMB posts
- [ ] A review request system in place
- [ ] Every review replied to

## 2. NAP consistency (most commonly broken)

Your **Name, Address, Phone** must be **byte-for-byte identical** everywhere: website, GMB, Justdial, Sulekha, IndiaMART, Facebook, LinkedIn.

- [ ] Pick one canonical format and write it down
- [ ] Audit every listing you can find
- [ ] Fix or delete duplicate/old listings
- [ ] Same phone number everywhere (not a different one per platform)

Inconsistent NAP confuses Google about which business is real. It is the quietest killer of local rankings.

## 3. On-page local signals

- [ ] City/service in your title tags where it is genuinely relevant
- [ ] **LocalBusiness schema** on the site (address, phone, hours, geo)
- [ ] NAP visible in the footer of every page
- [ ] An embedded Google Map on the contact page
- [ ] A dedicated page per major service
- [ ] Fast, mobile-first site (most local searches are on a phone)

## 4. Local citations (Indian directories)

Get listed, with identical NAP, on:

- [ ] Justdial
- [ ] Sulekha
- [ ] IndiaMART
- [ ] Bing Places
- [ ] Apple Business Connect
- [ ] Facebook & LinkedIn business pages
- [ ] Industry-specific Indian directories

## 5. Reviews (the compounding asset)

- [ ] Ask **every** happy customer — make it one click via a short link
- [ ] Aim for steady velocity, not a sudden burst
- [ ] Never buy reviews (Google detects it, and the penalty is brutal)
- [ ] Reply to every review, positive and negative
- [ ] Ask customers to mention *which service* you provided

## 6. Content that supports local intent

- [ ] Answer real local questions on your blog
- [ ] Publish case studies from local clients
- [ ] Get mentioned by local news, blogs and associations

## The five mistakes that kill local rankings

1. **Inconsistent NAP** across directories
2. **Wrong primary category** on GMB
3. **Buying reviews** (or getting 20 in one day)
4. **Keyword-stuffing your business name** — this is against Google's guidelines and gets profiles suspended
5. **Creating fake locations** to rank in more cities

## Realistic timeline

| Stage | Time |
|---|---|
| GMB verified + optimized | 1–3 weeks |
| Citations built | 2–4 weeks |
| First map pack appearances | 3–8 weeks |
| Stable top-3 in a competitive city | 3–6 months |

## FAQ

**Do I need a physical office?**
No. Register as a service-area business, hide the address, and list the areas you serve.

**Can I rank in multiple cities?**
In the map pack, only realistically where you are located. For other cities, build dedicated service pages and rank organically.

**How many citations do I need?**
Quality over quantity. Ten accurate, consistent listings beat a hundred sloppy ones.

---

We run [Google Business Profile optimization](/services/google-business-profile) and [local SEO](/services/seo) — including citation cleanup and a review system that actually works.

**[Get a free local SEO audit →](/contact)**
MD,
            ],
        ];

        foreach ($posts as $p) {
            Learning::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($p['title'])],
                [
                    'title'            => $p['title'],
                    'excerpt'          => $p['excerpt'],
                    'body'             => $p['body'],
                    'category_id'      => $id($p['cat']),
                    'tags'             => $p['tags'],
                    'meta_title'       => $p['meta_title'],
                    'meta_description' => $p['meta_description'],
                    'status'           => 'published',
                    'published_at'     => now()->subDays($p['days']),
                ]
            );
        }
    }
}
