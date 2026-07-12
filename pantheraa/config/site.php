<?php

/*
|--------------------------------------------------------------------------
| Pantheraa Space — Single source of truth for site content
|--------------------------------------------------------------------------
| Edit everything here: brand details, NAP (Name/Address/Phone for local
| SEO + schema), services, stats, process, testimonials and FAQs. Both the
| visible pages and the JSON-LD structured data are generated from this.
*/

return [

    'name'        => 'Pantheraa Space',
    'tagline'     => 'Digital Panther',
    'legal_name'  => 'Pantheraa Space',
    'short_desc'  => 'A performance-driven digital marketing agency engineering SEO, AEO, GEO & ASO growth for ambitious brands.',
    'founded'     => '2019',

    // The site URL is read from APP_URL in .env; keep this as a fallback.
    'url'         => env('APP_URL', 'http://localhost'),

    // ---- Contact / NAP (replace with the real business details) --------
    'email'       => 'techteam@icg-seo.com',
    'phone'       => '+91 98765 43210',
    'phone_link'  => '+919876543210',
    'address'     => [
        'street'   => '4th Floor, Cyber Hub Tower',
        'locality' => 'New Delhi',
        'region'   => 'Delhi',
        'postal'   => '110001',
        'country'  => 'IN',
    ],
    'geo'         => ['lat' => 28.6139, 'lng' => 77.2090],
    'hours'       => 'Mo-Sa 10:00-19:00',
    'price_range' => '₹₹',

    // ---- Social profiles (used for schema sameAs + footer) -------------
    'social' => [
        'linkedin'  => 'https://www.linkedin.com/company/pantheraa-space',
        'instagram' => 'https://www.instagram.com/pantheraa.space',
        'x'         => 'https://x.com/pantheraaspace',
        'youtube'   => 'https://www.youtube.com/@pantheraaspace',
    ],

    // ---- Headline numbers ---------------------------------------------
    // E-E-A-T: numbers here must be REAL and defensible. Add them from
    // Admin → Stats once you can back them up. Empty = the section is hidden.
    'stats' => [],

    // ---- Services ------------------------------------------------------
    'services' => [
        [
            'slug'  => 'ai-solutions',
            'name'  => 'AI Solutions & Automation',
            'short' => 'AI',
            'icon'  => 'bot',
            'featured' => true,
            'tagline' => 'Chatbots, agents & custom AI that work for you.',
            'desc'  => 'We design and build AI chatbots, autonomous agents and custom AI tools — trained on your own data to automate support, sales and operations.',
            'points' => ['AI chatbots & support assistants', 'Autonomous & workflow AI agents', 'Custom AI tools, copilots & RAG', 'Process & workflow automation'],
            'overview' => "We don't just talk about AI — we ship it. From customer-facing chatbots to autonomous agents and internal copilots, we design, build and deploy AI systems trained on your own data so they truly understand your business and move real numbers.",
            'deliverables' => [
                ['title' => 'AI Chatbots & Assistants', 'desc' => '24/7 web, WhatsApp and in-app bots that answer questions, qualify leads and book meetings.'],
                ['title' => 'Autonomous AI Agents', 'desc' => 'Multi-step agents that research, draft, decide and complete tasks across your tools.'],
                ['title' => 'Custom Copilots & RAG', 'desc' => 'Private assistants trained on your docs and brand voice — answers you can actually trust.'],
                ['title' => 'Workflow Automation', 'desc' => 'We connect your CRM, email, sheets and apps so repetitive work runs itself.'],
            ],
            'outcomes' => ['Cut response times from hours to seconds', 'Capture and qualify leads around the clock', 'Free your team from repetitive busywork'],
            'faqs' => [
                ['q' => 'Will the AI be trained on my business data?', 'a' => 'Yes. We use retrieval-augmented generation (RAG) and fine-tuning so the AI answers from your documents, products and policies — not generic internet guesses.'],
                ['q' => 'Where can the chatbot be deployed?', 'a' => 'Anywhere your customers are — your website, WhatsApp, Instagram and Messenger, or as an internal tool for your team.'],
            ],
        ],
        [
            'slug'  => 'seo',
            'name'  => 'Search Engine Optimization',
            'short' => 'SEO',
            'icon'  => 'search',
            'tagline' => 'Own page one for the keywords that pay.',
            'desc'  => 'Technical SEO, topical authority and link acquisition that compounds organic traffic into qualified pipeline.',
            'points' => ['Technical & Core Web Vitals audits', 'Topic-cluster content strategy', 'Authority link building', 'Local & Google Business Profile SEO'],
            'overview' => 'Sustainable organic growth, engineered. We fix the technical foundation, build topical authority and earn the links that move you up the rankings — turning search into your most profitable, compounding channel.',
            'deliverables' => [
                ['title' => 'Technical SEO Audit', 'desc' => 'Crawl, indexation, speed and Core Web Vitals fixes that unlock rankings.'],
                ['title' => 'Content & Topic Clusters', 'desc' => 'A keyword-mapped content plan that builds authority around what you sell.'],
                ['title' => 'Authority Link Building', 'desc' => 'White-hat digital PR and outreach that earns links search engines trust.'],
                ['title' => 'Local SEO', 'desc' => 'Google Business Profile, citations and reviews to win the local map pack.'],
            ],
            'outcomes' => ['Higher rankings for high-intent keywords', 'Compounding organic traffic that lowers CAC', 'More qualified leads without paying per click'],
            'faqs' => [
                ['q' => 'How long does SEO take to work?', 'a' => 'Most clients see momentum in 60–90 days, with step-change growth by month six. SEO compounds — the earlier you start, the bigger your lead.'],
                ['q' => 'Do you guarantee #1 rankings?', 'a' => 'No reputable agency can guarantee a specific position. We guarantee a transparent, proven process and report on rankings, traffic and revenue every month.'],
            ],
        ],
        [
            'slug'  => 'aeo-geo',
            'name'  => 'Answer & Generative Engine Optimization',
            'short' => 'AEO / GEO',
            'icon'  => 'spark',
            'tagline' => 'Get cited by AI, not skipped.',
            'desc'  => 'We structure your brand so ChatGPT, Gemini, Perplexity and Google AI Overviews quote you as the answer.',
            'points' => ['Schema & entity optimization', 'Answer-first content design', 'LLM citation monitoring', 'Knowledge-graph & E-E-A-T signals'],
            'overview' => "Search is moving inside AI. We optimize your brand so answer engines and generative AI — ChatGPT, Gemini, Perplexity and Google AI Overviews — cite you as the trusted answer, capturing demand your competitors can't even see yet.",
            'deliverables' => [
                ['title' => 'Structured Data & Schema', 'desc' => 'Entity, FAQ and product schema so machines understand exactly what you offer.'],
                ['title' => 'Answer-First Content', 'desc' => 'Concise, citable content designed to be lifted into AI answers and snippets.'],
                ['title' => 'Entity & Knowledge Graph', 'desc' => 'Consistent entity signals across the web that build machine trust and E-E-A-T.'],
                ['title' => 'AI Citation Monitoring', 'desc' => 'We track where AI tools mention you and double down on what works.'],
            ],
            'outcomes' => ['Get cited inside AI answers and overviews', 'Win featured snippets and voice results', 'Capture demand before the click disappears'],
            'faqs' => [
                ['q' => 'What is the difference between SEO and GEO?', 'a' => 'SEO ranks pages in search results. GEO (Generative Engine Optimization) gets your brand quoted inside AI-generated answers. As AI search grows, you need both.'],
                ['q' => 'Can you really influence what ChatGPT says?', 'a' => 'We can strongly influence it — through structured data, authoritative citable content and consistent entity signals that LLMs rely on — then monitor and iterate on real citations.'],
            ],
        ],
        [
            'slug'  => 'aso',
            'name'  => 'App Store Optimization',
            'short' => 'ASO',
            'icon'  => 'mobile',
            'tagline' => 'More installs at a lower cost.',
            'desc'  => 'Keyword-rich store listings, creative testing and rating strategy to lift App Store and Play Store rankings.',
            'points' => ['Store keyword research', 'Listing & creative A/B testing', 'Conversion-rate optimization', 'Rating & review velocity'],
            'overview' => 'Your app deserves to be found. We optimize every lever of your App Store and Google Play listing — keywords, creatives, ratings and conversion — to drive more installs at a lower cost per install.',
            'deliverables' => [
                ['title' => 'Store Keyword Research', 'desc' => 'Find the high-volume, winnable keywords your ideal users actually search.'],
                ['title' => 'Listing Optimization', 'desc' => 'Title, subtitle, description and metadata tuned for rankings and conversion.'],
                ['title' => 'Creative A/B Testing', 'desc' => 'Icon, screenshots and preview videos tested to maximise install rate.'],
                ['title' => 'Ratings & Reviews', 'desc' => 'Strategies to grow rating velocity and respond to the reviews that matter.'],
            ],
            'outcomes' => ['Higher store rankings for key terms', 'More organic installs at a lower CPI', 'A better store-listing conversion rate'],
            'faqs' => [
                ['q' => 'Do you optimize for both the App Store and Play Store?', 'a' => 'Yes. We handle both the Apple App Store and Google Play, tailoring keywords and creatives to each platform\'s algorithm.'],
                ['q' => 'Is ASO a one-time project?', 'a' => 'ASO works best as an ongoing program — store algorithms, competitors and trends shift constantly, so we test and iterate continuously.'],
            ],
        ],
        [
            'slug'  => 'paid-media',
            'name'  => 'Performance Marketing',
            'short' => 'Paid Media',
            'icon'  => 'target',
            'tagline' => 'Profitable spend, scaled.',
            'desc'  => 'Full-funnel Google, Meta and LinkedIn campaigns engineered around ROAS, not vanity clicks.',
            'points' => ['Google & Meta Ads management', 'Creative & landing-page testing', 'Tracking & attribution setup', 'Budget scaling playbooks'],
            'overview' => 'Spend that pays you back. We build full-funnel paid campaigns on Google, Meta and LinkedIn around the one metric that matters — return on ad spend — with relentless creative testing and clean attribution.',
            'deliverables' => [
                ['title' => 'Strategy & Account Setup', 'desc' => 'Account structure, audiences and bidding built for profitable scale.'],
                ['title' => 'Creative & Landing Tests', 'desc' => 'Ad creative and landing-page experiments that lift conversion rates.'],
                ['title' => 'Tracking & Attribution', 'desc' => 'Server-side tracking and analytics so you can trust every number.'],
                ['title' => 'Scaling Playbooks', 'desc' => 'Systematic budget scaling that protects ROAS as you grow.'],
            ],
            'outcomes' => ['Higher ROAS and lower cost per acquisition', 'Predictable, scalable lead and sales volume', 'Clear attribution from click to revenue'],
            'faqs' => [
                ['q' => 'What is the minimum ad budget you work with?', 'a' => "We typically start around \$1k+ per month in ad spend, scaling to six figures. We'll recommend the right budget for your goals in the free audit."],
                ['q' => 'Which ad platforms do you cover?', 'a' => 'Google (Search, Performance Max, YouTube), Meta (Facebook & Instagram) and LinkedIn — chosen based on where your buyers actually convert.'],
            ],
        ],
        [
            'slug'  => 'social-content',
            'name'  => 'Social Media & Content',
            'short' => 'Social',
            'icon'  => 'chat',
            'tagline' => 'Be the brand people screenshot.',
            'desc'  => 'Thumb-stopping short-form content, community management and a calendar that keeps you culturally relevant.',
            'points' => ['Short-form video & reels', 'Always-on community management', 'Influencer collaborations', 'Content calendars that ship'],
            'overview' => 'Attention is the new currency. We create thumb-stopping short-form content, run always-on community management and ship a consistent calendar that keeps your brand culturally relevant and top of mind.',
            'deliverables' => [
                ['title' => 'Short-Form Video & Reels', 'desc' => 'Scroll-stopping reels, shorts and TikToks built for reach and saves.'],
                ['title' => 'Content Calendar', 'desc' => 'A consistent, on-brand posting plan across the channels that matter.'],
                ['title' => 'Community Management', 'desc' => 'Always-on engagement, DMs and comments that build loyal audiences.'],
                ['title' => 'Influencer Collaborations', 'desc' => 'Creator partnerships that put your brand in front of warm audiences.'],
            ],
            'outcomes' => ['Grow a following that actually converts', 'Stay culturally relevant and memorable', 'Turn content into a reliable demand channel'],
            'faqs' => [
                ['q' => 'Which social platforms do you manage?', 'a' => 'Instagram, TikTok, LinkedIn, YouTube, Facebook and X — we focus on where your audience actually spends time.'],
                ['q' => 'Do you create the content or just schedule it?', 'a' => 'Both. We script, shoot and edit short-form video, design creative, write copy and publish — a full content engine, not just a scheduler.'],
            ],
        ],
        [
            'slug'  => 'web-design',
            'name'  => 'Web Design & Development',
            'short' => 'Web',
            'icon'  => 'code',
            'tagline' => 'Fast sites that convert.',
            'desc'  => 'Conversion-first websites built on modern stacks — quick, accessible, and tuned for Core Web Vitals.',
            'points' => ['Conversion-focused UX/UI', 'Headless & Laravel builds', 'Core Web Vitals performance', 'CRO & analytics wiring'],
            'overview' => 'Your website is your hardest-working salesperson. We design and build fast, accessible, conversion-first sites on modern stacks — tuned for Core Web Vitals and wired to measure everything.',
            'deliverables' => [
                ['title' => 'Conversion-First UX/UI', 'desc' => 'Research-backed design that guides visitors smoothly to action.'],
                ['title' => 'Modern Development', 'desc' => 'Laravel, headless and Jamstack builds that are fast and maintainable.'],
                ['title' => 'Performance & Core Web Vitals', 'desc' => 'Sub-second loads that please users and search engines alike.'],
                ['title' => 'CRO & Analytics', 'desc' => 'Tracking, A/B tests and heatmaps so the site keeps improving.'],
            ],
            'outcomes' => ['Higher conversion rates from the same traffic', 'Faster loads and better Core Web Vitals', 'A site that is easy to update and scale'],
            'faqs' => [
                ['q' => 'What tech stack do you build on?', 'a' => 'Modern, reliable stacks — Laravel + Livewire, headless CMS and Jamstack — chosen for speed, security and easy maintenance.'],
                ['q' => 'Can you redesign my existing site?', 'a' => 'Absolutely. We can refresh or fully rebuild, migrating your content while preserving and usually improving your SEO.'],
            ],
        ],
    ],

    // ---- Process -------------------------------------------------------
    'process' => [
        ['no' => '01', 'title' => 'Audit & Discover', 'desc' => 'We benchmark your funnel, competitors and search/AI visibility to find the fastest levers.'],
        ['no' => '02', 'title' => 'Strategy & Roadmap', 'desc' => 'A prioritized, channel-by-channel growth roadmap mapped to clear revenue targets.'],
        ['no' => '03', 'title' => 'Execute & Launch', 'desc' => 'Our specialists ship content, campaigns and code — fast, with weekly momentum.'],
        ['no' => '04', 'title' => 'Measure & Scale', 'desc' => 'Transparent dashboards, relentless testing, and reinvestment into what wins.'],
    ],

    // ---- Testimonials --------------------------------------------------
    // E-E-A-T: ONLY real testimonials, from real clients, with their permission.
    // Fabricated social proof is detectable, damages trust and is legally risky.
    // Add them from Admin → Testimonials. Empty = the section is hidden.
    'testimonials' => [],

    // ---- FAQ (also rendered as FAQPage JSON-LD for AEO) ---------------
    'faqs' => [
        ['q' => 'What does a digital marketing agency like Pantheraa Space actually do?', 'a' => 'Pantheraa Space is a full-service digital marketing agency. We plan and execute SEO, AEO/GEO (AI-search), ASO, paid media, social content and high-converting websites — all measured against revenue, not vanity metrics.'],
        ['q' => 'What is the difference between SEO, AEO and GEO?', 'a' => 'SEO ranks you in classic search results. AEO (Answer Engine Optimization) gets you into featured answers and voice results. GEO (Generative Engine Optimization) makes AI tools like ChatGPT, Gemini and Google AI Overviews cite your brand. We optimize for all three together.'],
        ['q' => 'Do you build AI chatbots, agents and custom AI tools?', 'a' => 'Yes. Beyond marketing, Pantheraa Space builds AI products: customer-support and lead-gen chatbots, autonomous AI agents, custom copilots and RAG tools trained on your own data, plus workflow automation that connects your existing stack. We can deploy on your website, WhatsApp or internal tools.'],
        ['q' => 'How soon will I see results?', 'a' => 'Paid media and ASO can move within weeks. SEO, AEO and GEO are compounding channels — most clients see meaningful momentum in 60–90 days and step-change growth by month six.'],
        ['q' => 'Do you work with startups and small businesses?', 'a' => 'Yes. We run engagements from focused single-channel sprints for early-stage startups up to full-funnel growth retainers for funded and enterprise brands.'],
        ['q' => 'How do you report on performance?', 'a' => 'Every client gets a live dashboard plus a monthly review call. We report on pipeline, revenue and ROAS — the numbers that matter — with full transparency.'],
        ['q' => 'How do we get started?', 'a' => 'Send us your goals through the contact form and we will reply within one business day with a free growth audit and a recommended roadmap.'],
    ],

    // ---- Learnings (daily learning notes / essays) --------------------
    'learnings' => [
        'tagline'    => 'Daily notes on AI, LLMs, RAG & building on the frontier.',
        'categories' => ['AI News', 'LLMs', 'RAG', 'Prompting', 'Agents', 'Machine Learning', 'Code', 'Math', 'Essay', 'Tools'],
    ],
];
