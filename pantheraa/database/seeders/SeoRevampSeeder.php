<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Redirect;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * Rebuilds the site's commercial content around the services we actually sell,
 * with keyword-targeted copy + meta for each (India-wide, buyer intent).
 * Each service becomes its own landing page at /services/{slug}.
 */
class SeoRevampSeeder extends Seeder
{
    public function run(): void
    {
        // ── Brand / SEO defaults ──────────────────────────────────────────
        Setting::put('short_desc', 'Pantheraa Space is an India-based digital marketing & development agency. We build websites and custom software, run Google & Meta Ads, and grow your visibility with SEO, Google Business Profile and AI search optimization (AIO).');
        Setting::put('seo_title_suffix', 'Pantheraa Space');
        Setting::put('seo_default_description', 'Website development, custom software, Google & Meta Ads, SEO, GMB and AI search optimization (AIO) for Indian businesses. Get a free growth audit.');

        // ── Services (each = a keyword-targeted landing page) ─────────────
        $services = [
            [
                'slug' => 'website-development',
                'name' => 'Website Development',
                'short' => 'Web',
                'icon' => 'code',
                'tagline' => "Websites that don't just look good — they sell.",
                'description' => 'Fast, mobile-first, SEO-ready websites built to turn visitors into enquiries — not just impress them.',
                'overview' => 'Your website is your hardest-working salesperson — it should be selling 24/7. We design and build business and e-commerce websites that load in under a second, look sharp on every phone, and are structured so Google can rank them from day one. And you get a CMS, so you can update content yourself without calling a developer.',
                'meta_title' => 'Website Development Company in India — Fast, SEO-Ready Websites',
                'meta_description' => 'Custom website development for Indian businesses. Mobile-first, lightning-fast, SEO-ready websites that convert visitors into customers. Get a free quote today.',
                'points' => ['Business & e-commerce websites', 'Mobile-first and lightning fast', 'SEO-ready from day one', 'Easy CMS — edit it yourself'],
                'deliverables' => [
                    ['title' => 'Conversion-first design', 'desc' => 'Every section is built to move visitors toward one action: contacting you.'],
                    ['title' => 'Custom development', 'desc' => 'Laravel, WordPress or headless — chosen for your needs, not our convenience.'],
                    ['title' => 'Speed & Core Web Vitals', 'desc' => 'Sub-second loads. Faster sites rank higher and convert better.'],
                    ['title' => 'SEO & analytics setup', 'desc' => 'Schema, sitemap, Search Console and GA4 wired in before launch.'],
                ],
                'outcomes' => ['More enquiries from the same traffic', 'A site you can update yourself', 'Better Google rankings from a faster site'],
                'faqs' => [
                    ['q' => 'How much does a website cost in India?', 'a' => 'A professional business website typically ranges from ₹25,000 to ₹1,50,000+ depending on pages, features and whether you need e-commerce or custom functionality. We give you a fixed quote after a free 15-minute scoping call — no surprises.'],
                    ['q' => 'How long does it take to build a website?', 'a' => 'A standard business website takes 2–4 weeks. E-commerce or custom-feature sites take 4–8 weeks. We share a clear timeline before we start and keep you updated weekly.'],
                    ['q' => 'Will I be able to edit the website myself?', 'a' => 'Yes. Every site we build comes with an easy admin panel so you can update text, images, blogs and offers yourself — no coding and no dependency on us.'],
                ],
            ],
            [
                'slug' => 'software-development',
                'name' => 'Software & App Development',
                'short' => 'Software',
                'icon' => 'workflow',
                'tagline' => 'Custom software built around how you actually work.',
                'description' => 'Web apps, mobile apps, CRMs and automations that remove manual work and scale with your business.',
                'overview' => "Off-the-shelf tools force you to work their way. We build software around your actual process — web apps, SaaS platforms, mobile apps, CRMs, dashboards and automations. From the first whiteboard sketch to launch and support, one team owns it end to end.",
                'meta_title' => 'Custom Software & Mobile App Development Company in India',
                'meta_description' => 'Custom software development in India — web apps, SaaS platforms, Android & iOS apps, CRMs and automations. From idea to launch with one accountable team.',
                'points' => ['Custom web apps & SaaS platforms', 'Android & iOS mobile apps', 'CRM, ERP & admin dashboards', 'AI chatbots, agents & automations'],
                'deliverables' => [
                    ['title' => 'Discovery & scoping', 'desc' => 'We map your process first, so we build the right thing — not just the asked thing.'],
                    ['title' => 'UI/UX design', 'desc' => 'Interfaces your team will actually enjoy using every day.'],
                    ['title' => 'Development & QA', 'desc' => 'Clean, tested, documented code on modern, maintainable stacks.'],
                    ['title' => 'Launch & support', 'desc' => 'Deployment, training and ongoing support — we do not disappear after go-live.'],
                ],
                'outcomes' => ['Automate hours of manual work every week', 'Systems that scale as you grow', 'One accountable team from idea to launch'],
                'faqs' => [
                    ['q' => 'What technologies do you build on?', 'a' => 'We build on modern, reliable and maintainable stacks — Laravel, Node.js, React, React Native and Flutter — plus AI/LLM integrations where they add real value. We pick the stack for your needs, not for hype.'],
                    ['q' => 'Do you provide support after launch?', 'a' => 'Yes. Every project includes a warranty period, and we offer ongoing maintenance and support retainers so your software keeps running and improving.'],
                ],
            ],
            [
                'slug' => 'seo',
                'name' => 'SEO Services',
                'short' => 'SEO',
                'icon' => 'search',
                'tagline' => 'Rank where your customers are already searching.',
                'description' => 'Technical SEO, content and authority building that turns organic search into a steady stream of qualified leads.',
                'overview' => "SEO is the only channel that keeps paying after you stop spending. We fix your technical foundation, build content around the keywords your buyers actually search, and earn the authority Google needs to trust you. It compounds — every month builds on the last.",
                'meta_title' => 'SEO Services in India — SEO Company That Delivers Leads',
                'meta_description' => 'Result-driven SEO services in India. Technical SEO, content strategy and quality link building that turn organic traffic into qualified leads. Get a free SEO audit.',
                'points' => ['Technical SEO & Core Web Vitals', 'Keyword research & content strategy', 'Quality link building (white-hat)', 'Transparent rank & traffic reporting'],
                'deliverables' => [
                    ['title' => 'Full technical audit', 'desc' => 'Crawl, indexing, speed and structure issues found and fixed.'],
                    ['title' => 'Keyword map & content plan', 'desc' => 'We target the keywords buyers search — not just high-volume vanity terms.'],
                    ['title' => 'On-page optimization', 'desc' => 'Titles, meta, headings, internal links and schema, done properly.'],
                    ['title' => 'Authority link building', 'desc' => 'White-hat digital PR and outreach that earns links Google respects.'],
                ],
                'outcomes' => ['Rank for keywords that bring buyers', 'Traffic that compounds and lowers your CAC', 'Leads without paying for every click'],
                'faqs' => [
                    ['q' => 'How long does SEO take to show results in India?', 'a' => 'For low-competition and long-tail keywords you can see movement in 6–10 weeks. Competitive head terms typically take 4–6 months. Anyone promising #1 in 30 days is not being honest with you. We show you leading indicators (impressions, rankings, clicks) from month one.'],
                    ['q' => 'Do you guarantee a #1 ranking?', 'a' => 'No — and no honest agency can, because Google controls rankings. What we guarantee is a transparent, proven process and monthly reporting on rankings, traffic and leads so you always know exactly what you are paying for.'],
                    ['q' => 'Is SEO better than Google Ads?', 'a' => 'They do different jobs. Ads give you leads today but stop the moment you stop paying. SEO takes a few months but compounds and keeps delivering. The strongest strategy runs ads for immediate leads while SEO builds in the background.'],
                ],
            ],
            [
                'slug' => 'google-ads',
                'name' => 'Google Ads Management',
                'short' => 'Google Ads',
                'icon' => 'target',
                'tagline' => 'Spend that brings buyers, not just clicks.',
                'description' => 'Search, Performance Max and YouTube campaigns engineered around leads and ROAS — with tracking you can actually trust.',
                'overview' => "Most Google Ads accounts quietly burn money on clicks that were never going to buy. We rebuild yours around intent: the right keywords, tight negatives, ad copy that pre-qualifies, and landing pages that convert. Then we track every rupee to a real lead.",
                'meta_title' => 'Google Ads Agency in India — PPC Management That Brings Leads',
                'meta_description' => 'Google Ads management for Indian businesses. Search, Performance Max & YouTube campaigns built for leads and ROAS — with proper conversion tracking. Free ad account audit.',
                'points' => ['Search, Performance Max & YouTube', 'Keyword & competitor research', 'Landing pages built to convert', 'Conversion tracking & weekly reporting'],
                'deliverables' => [
                    ['title' => 'Account audit & rebuild', 'desc' => 'We find the leaks first — wasted spend, missing negatives, broken tracking.'],
                    ['title' => 'Keyword & audience strategy', 'desc' => 'Target buying intent, exclude the tyre-kickers.'],
                    ['title' => 'Ad copy & landing page testing', 'desc' => 'Continuous A/B testing to push your cost per lead down.'],
                    ['title' => 'Conversion tracking & reporting', 'desc' => 'Know exactly which campaign produced which enquiry.'],
                ],
                'outcomes' => ['Lower cost per lead', 'A predictable flow of enquiries', 'Total clarity on what your ad spend returns'],
                'faqs' => [
                    ['q' => 'What is the minimum Google Ads budget I need?', 'a' => 'For most Indian service businesses we recommend starting at ₹30,000–₹50,000 per month in ad spend so there is enough data to optimize. We will tell you honestly in the free audit if your budget is too low to work.'],
                    ['q' => 'How soon will I start getting leads from Google Ads?', 'a' => 'Usually within the first 1–2 weeks of launch. The first month is about gathering data; from month two we optimize hard to bring your cost per lead down.'],
                ],
            ],
            [
                'slug' => 'meta-ads',
                'name' => 'Meta Ads (Facebook & Instagram)',
                'short' => 'Meta Ads',
                'icon' => 'bolt',
                'tagline' => 'Scroll-stopping ads that fill your pipeline.',
                'description' => 'Facebook and Instagram campaigns with creative that stops the scroll — and tracking that survives iOS.',
                'overview' => "On Meta, the creative IS the targeting. We produce thumb-stopping static and video ads, build the offer around what your buyer actually wants, and set up proper Pixel + Conversions API tracking so you can trust your numbers again.",
                'meta_title' => 'Facebook & Instagram (Meta) Ads Agency in India — Lead Gen That Works',
                'meta_description' => 'Meta Ads management in India. Facebook & Instagram campaigns with scroll-stopping creative, retargeting and full Pixel + CAPI tracking. Get more leads for less.',
                'points' => ['Facebook & Instagram campaigns', 'Creative & short-form video production', 'Retargeting & lookalike audiences', 'Pixel + Conversions API tracking'],
                'deliverables' => [
                    ['title' => 'Offer & audience strategy', 'desc' => 'The right message to the right person — the two things that decide everything.'],
                    ['title' => 'Creative production', 'desc' => 'Static and video ads made to stop the scroll, tested continuously.'],
                    ['title' => 'Campaign build & scaling', 'desc' => 'Structured scaling that protects your ROAS as budgets grow.'],
                    ['title' => 'Pixel & CAPI setup', 'desc' => 'Server-side tracking so you get accurate data after iOS restrictions.'],
                ],
                'outcomes' => ['Cheaper leads, at scale', 'Creative that actually converts', 'Tracking you can finally trust'],
                'faqs' => [
                    ['q' => 'Do you make the ad creatives too?', 'a' => 'Yes — creative is the biggest lever on Meta, so we never leave it to chance. We script, design and edit static and video ads in-house and test new angles every month.'],
                    ['q' => 'Do Meta ads work for B2B or high-ticket services?', 'a' => 'Absolutely — when the offer and creative are right. We use lead magnets, qualification questions and retargeting to filter out the noise and bring you serious enquiries, not just cheap clicks.'],
                ],
            ],
            [
                'slug' => 'google-business-profile',
                'name' => 'Google Business Profile (GMB)',
                'short' => 'GMB',
                'icon' => 'pin',
                'tagline' => 'Show up in the map pack. Get calls today.',
                'description' => 'GMB setup, optimization and management that puts you in the local 3-pack and turns searches into phone calls.',
                'overview' => "When someone searches for your service 'near me', Google shows three businesses on the map. Being one of them is the fastest, cheapest source of leads for most local businesses. We set up, verify and fully optimize your Google Business Profile — then keep it active with posts and reviews so you stay there.",
                'meta_title' => 'Google Business Profile (GMB) Optimization Services in India',
                'meta_description' => 'GMB setup, verification and optimization — rank in the Google map pack, get more calls, direction requests and 5-star reviews. Local SEO that brings leads fast.',
                'points' => ['Profile setup & verification', 'Category, service & photo optimization', 'Weekly GMB posts & Q&A', 'Review generation and responses'],
                'deliverables' => [
                    ['title' => 'Setup, claim & verification', 'desc' => 'We handle the whole process — including tricky verification cases.'],
                    ['title' => 'Full profile optimization', 'desc' => 'Categories, services, attributes, photos and description tuned to rank.'],
                    ['title' => 'Weekly posts & Q&A', 'desc' => 'An active profile ranks better — we keep yours alive.'],
                    ['title' => 'Review strategy', 'desc' => 'A system to earn genuine 5-star reviews and reply to every one.'],
                ],
                'outcomes' => ['Appear in the local 3-pack', 'More calls and direction requests', 'Trust built by real, recent reviews'],
                'faqs' => [
                    ['q' => 'How long does it take to rank in the Google map pack?', 'a' => 'For most businesses, 3–8 weeks after the profile is verified and fully optimized — far faster than traditional SEO. Highly competitive cities and categories take longer and need review velocity.'],
                    ['q' => 'What if my business has no physical office or storefront?', 'a' => 'You can still create a Google Business Profile as a service-area business — you hide the address and list the areas you serve. We set this up correctly so it gets verified without issues.'],
                ],
            ],
            [
                'slug' => 'ai-search-optimization',
                'name' => 'AIO — AI Search Optimization',
                'short' => 'AIO',
                'icon' => 'spark',
                'featured' => true,
                'tagline' => 'Get recommended by ChatGPT, Gemini & Google AI.',
                'description' => 'AI Optimization (AEO + GEO): get your brand cited as the answer inside ChatGPT, Gemini, Perplexity and Google AI Overviews.',
                'overview' => "Your customers have started asking AI instead of Google — and AI recommends a handful of brands, not ten blue links. AIO makes sure you are one of them. We structure your entities, schema and content so answer engines and generative AI quote YOU. Competition here is still tiny; this is the early-mover window.",
                'meta_title' => 'AIO — AI Search Optimization (AEO & GEO) Services in India',
                'meta_description' => 'AI Optimization services: get cited by ChatGPT, Gemini, Perplexity and Google AI Overviews. Answer Engine (AEO) + Generative Engine (GEO) optimization for your brand.',
                'points' => ['Schema & entity optimization', 'Answer-first content built to be quoted', 'AI citation tracking & monitoring', 'E-E-A-T and knowledge-graph signals'],
                'deliverables' => [
                    ['title' => 'Entity & schema foundation', 'desc' => 'So machines understand exactly who you are and what you do.'],
                    ['title' => 'Answer-first content', 'desc' => 'Concise, citable content written the way AI likes to quote it.'],
                    ['title' => 'AI visibility monitoring', 'desc' => 'We track where ChatGPT, Gemini and AI Overviews mention you.'],
                    ['title' => 'Authority & E-E-A-T signals', 'desc' => 'The trust markers AI models weigh before recommending anyone.'],
                ],
                'outcomes' => ['Get cited inside AI answers', 'Win featured snippets and voice results', 'Capture demand before the click disappears'],
                'faqs' => [
                    ['q' => 'What exactly is AIO, AEO and GEO?', 'a' => 'AIO (AI Optimization) is the umbrella term. AEO (Answer Engine Optimization) gets you into direct answers, featured snippets and voice results. GEO (Generative Engine Optimization) gets your brand quoted inside AI-generated answers from ChatGPT, Gemini and Google AI Overviews. We do all three together.'],
                    ['q' => 'Can you really influence what ChatGPT says about my industry?', 'a' => 'Yes — strongly. LLMs rely on structured data, authoritative citable sources and consistent entity signals across the web. We build all three, then monitor real citations and iterate. It is not magic, it is engineering.'],
                    ['q' => 'Why should I care about AI search now?', 'a' => 'Because the competition has not woken up yet. Ranking in AI answers today costs a fraction of what it will cost once every agency is selling AIO. This is the same window SEO had in 2010.'],
                ],
            ],
        ];

        Service::query()->delete();
        foreach ($services as $i => $s) {
            Service::create(array_merge($s, [
                'sort' => $i,
                'is_active' => true,
                'featured' => $s['featured'] ?? false,
            ]));
        }

        // ── Homepage FAQs (buyer intent + AEO/AI citation bait) ───────────
        $faqs = [
            ['q' => 'What services does Pantheraa Space offer?', 'a' => 'Pantheraa Space is a full-service digital agency in India. We build websites and custom software (including mobile apps and AI chatbots), run Google Ads and Meta (Facebook/Instagram) Ads, and grow your visibility through SEO, Google Business Profile (GMB) optimization and AI search optimization (AIO/AEO/GEO).'],
            ['q' => 'How much does a website cost in India?', 'a' => 'A professional business website generally costs between ₹25,000 and ₹1,50,000+, depending on the number of pages, custom features and whether you need e-commerce. We provide a fixed quote after a free scoping call, so there are no surprises.'],
            ['q' => 'How long does SEO take to bring leads?', 'a' => 'Long-tail and low-competition keywords can start moving in 6–10 weeks. Competitive terms usually take 4–6 months. For faster leads we recommend running Google Business Profile and paid ads alongside SEO, so you get enquiries while SEO compounds in the background.'],
            ['q' => 'Do you work with startups and small businesses?', 'a' => 'Yes. We work with everyone from early-stage startups needing a first website to established brands running full-funnel growth programs. We will tell you honestly which channel gives you the best return for your budget.'],
            ['q' => 'What is AIO (AI Optimization) and why does it matter?', 'a' => 'AIO makes sure AI tools like ChatGPT, Gemini, Perplexity and Google AI Overviews recommend your brand when someone asks about your category. As buyers shift from searching to asking AI, being one of the few brands the AI cites becomes the single highest-leverage visibility play — and right now, almost nobody is competing for it.'],
            ['q' => 'How do I get started with Pantheraa Space?', 'a' => 'Send us your goals through the contact form or WhatsApp us. We reply within one business day with a free audit of your current website, ads or search visibility, plus a clear, prioritised roadmap. No obligation.'],
        ];

        Faq::query()->delete();
        foreach ($faqs as $i => $f) {
            Faq::create(['question' => $f['q'], 'answer' => $f['a'], 'sort' => $i, 'is_active' => true]);
        }

        // ── 301s from the old service URLs to the new ones ────────────────
        $redirects = [
            '/services/web-design'     => '/services/website-development',
            '/services/ai-solutions'   => '/services/software-development',
            '/services/aso'            => '/services/software-development',
            '/services/paid-media'     => '/services/google-ads',
            '/services/social-content' => '/services/meta-ads',
            '/services/aeo-geo'        => '/services/ai-search-optimization',
        ];
        foreach ($redirects as $from => $to) {
            Redirect::updateOrCreate(
                ['source' => $from],
                ['destination' => $to, 'status_code' => 301, 'is_active' => true, 'notes' => 'Service revamp']
            );
        }
    }
}
