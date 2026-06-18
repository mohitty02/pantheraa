
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('pantheraa-space-cache-redirects.map','a:0:{}',2097135905),('pantheraa-space-cache-site.content','a:22:{s:4:\"name\";s:15:\"Pantheraa Space\";s:7:\"tagline\";s:15:\"Digital Panther\";s:10:\"legal_name\";s:15:\"Pantheraa Space\";s:10:\"short_desc\";s:106:\"A performance-driven digital marketing agency engineering SEO, AEO, GEO & ASO growth for ambitious brands.\";s:7:\"founded\";s:4:\"2019\";s:5:\"email\";s:20:\"techteam@icg-seo.com\";s:5:\"phone\";s:15:\"+91 98765 43210\";s:10:\"phone_link\";s:13:\"+919876543210\";s:5:\"hours\";s:17:\"Mo-Sa 10:00-19:00\";s:11:\"price_range\";s:6:\"₹₹\";s:7:\"address\";a:5:{s:6:\"street\";s:26:\"4th Floor, Cyber Hub Tower\";s:8:\"locality\";s:9:\"New Delhi\";s:6:\"region\";s:5:\"Delhi\";s:6:\"postal\";s:6:\"110001\";s:7:\"country\";s:2:\"IN\";}s:3:\"geo\";a:2:{s:3:\"lat\";d:28.6139;s:3:\"lng\";d:77.209;}s:6:\"social\";a:4:{s:8:\"linkedin\";s:48:\"https://www.linkedin.com/company/pantheraa-space\";s:9:\"instagram\";s:41:\"https://www.instagram.com/pantheraa.space\";s:1:\"x\";s:28:\"https://x.com/pantheraaspace\";s:7:\"youtube\";s:39:\"https://www.youtube.com/@pantheraaspace\";}s:9:\"learnings\";a:2:{s:7:\"tagline\";s:56:\"Daily notes on AI, LLMs, RAG & building on the frontier.\";s:10:\"categories\";a:10:{i:0;s:7:\"AI News\";i:1;s:4:\"LLMs\";i:2;s:3:\"RAG\";i:3;s:9:\"Prompting\";i:4;s:6:\"Agents\";i:5;s:16:\"Machine Learning\";i:6;s:4:\"Code\";i:7;s:4:\"Math\";i:8;s:5:\"Essay\";i:9;s:5:\"Tools\";}}s:8:\"tracking\";a:6:{s:6:\"gtm_id\";s:0:\"\";s:6:\"ga4_id\";s:0:\"\";s:13:\"meta_pixel_id\";s:0:\"\";s:10:\"clarity_id\";s:0:\"\";s:9:\"hotjar_id\";s:0:\"\";s:16:\"gsc_verification\";s:0:\"\";}s:3:\"seo\";a:5:{s:12:\"title_suffix\";s:0:\"\";s:19:\"default_description\";s:0:\"\";s:13:\"default_image\";s:0:\"\";s:12:\"twitter_site\";s:0:\"\";s:11:\"author_name\";s:0:\"\";}s:8:\"services\";a:7:{i:0;a:12:{s:4:\"slug\";s:12:\"ai-solutions\";s:4:\"name\";s:25:\"AI Solutions & Automation\";s:5:\"short\";s:2:\"AI\";s:4:\"icon\";s:3:\"bot\";s:8:\"featured\";b:1;s:7:\"tagline\";s:47:\"Chatbots, agents & custom AI that work for you.\";s:4:\"desc\";s:142:\"We design and build AI chatbots, autonomous agents and custom AI tools — trained on your own data to automate support, sales and operations.\";s:8:\"overview\";s:243:\"We don\'t just talk about AI — we ship it. From customer-facing chatbots to autonomous agents and internal copilots, we design, build and deploy AI systems trained on your own data so they truly understand your business and move real numbers.\";s:6:\"points\";a:4:{i:0;s:32:\"AI chatbots & support assistants\";i:1;s:31:\"Autonomous & workflow AI agents\";i:2;s:31:\"Custom AI tools, copilots & RAG\";i:3;s:29:\"Process & workflow automation\";}s:12:\"deliverables\";a:4:{i:0;a:2:{s:5:\"title\";s:24:\"AI Chatbots & Assistants\";s:4:\"desc\";s:90:\"24/7 web, WhatsApp and in-app bots that answer questions, qualify leads and book meetings.\";}i:1;a:2:{s:5:\"title\";s:20:\"Autonomous AI Agents\";s:4:\"desc\";s:84:\"Multi-step agents that research, draft, decide and complete tasks across your tools.\";}i:2;a:2:{s:5:\"title\";s:21:\"Custom Copilots & RAG\";s:4:\"desc\";s:91:\"Private assistants trained on your docs and brand voice — answers you can actually trust.\";}i:3;a:2:{s:5:\"title\";s:19:\"Workflow Automation\";s:4:\"desc\";s:75:\"We connect your CRM, email, sheets and apps so repetitive work runs itself.\";}}s:8:\"outcomes\";a:3:{i:0;s:40:\"Cut response times from hours to seconds\";i:1;s:42:\"Capture and qualify leads around the clock\";i:2;s:39:\"Free your team from repetitive busywork\";}s:4:\"faqs\";a:2:{i:0;a:2:{s:1:\"q\";s:43:\"Will the AI be trained on my business data?\";s:1:\"a\";s:159:\"Yes. We use retrieval-augmented generation (RAG) and fine-tuning so the AI answers from your documents, products and policies — not generic internet guesses.\";}i:1;a:2:{s:1:\"q\";s:34:\"Where can the chatbot be deployed?\";s:1:\"a\";s:118:\"Anywhere your customers are — your website, WhatsApp, Instagram and Messenger, or as an internal tool for your team.\";}}}i:1;a:12:{s:4:\"slug\";s:3:\"seo\";s:4:\"name\";s:26:\"Search Engine Optimization\";s:5:\"short\";s:3:\"SEO\";s:4:\"icon\";s:6:\"search\";s:8:\"featured\";b:0;s:7:\"tagline\";s:39:\"Own page one for the keywords that pay.\";s:4:\"desc\";s:109:\"Technical SEO, topical authority and link acquisition that compounds organic traffic into qualified pipeline.\";s:8:\"overview\";s:212:\"Sustainable organic growth, engineered. We fix the technical foundation, build topical authority and earn the links that move you up the rankings — turning search into your most profitable, compounding channel.\";s:6:\"points\";a:4:{i:0;s:34:\"Technical & Core Web Vitals audits\";i:1;s:30:\"Topic-cluster content strategy\";i:2;s:23:\"Authority link building\";i:3;s:35:\"Local & Google Business Profile SEO\";}s:12:\"deliverables\";a:4:{i:0;a:2:{s:5:\"title\";s:19:\"Technical SEO Audit\";s:4:\"desc\";s:72:\"Crawl, indexation, speed and Core Web Vitals fixes that unlock rankings.\";}i:1;a:2:{s:5:\"title\";s:24:\"Content & Topic Clusters\";s:4:\"desc\";s:73:\"A keyword-mapped content plan that builds authority around what you sell.\";}i:2;a:2:{s:5:\"title\";s:23:\"Authority Link Building\";s:4:\"desc\";s:72:\"White-hat digital PR and outreach that earns links search engines trust.\";}i:3;a:2:{s:5:\"title\";s:9:\"Local SEO\";s:4:\"desc\";s:73:\"Google Business Profile, citations and reviews to win the local map pack.\";}}s:8:\"outcomes\";a:3:{i:0;s:40:\"Higher rankings for high-intent keywords\";i:1;s:43:\"Compounding organic traffic that lowers CAC\";i:2;s:45:\"More qualified leads without paying per click\";}s:4:\"faqs\";a:2:{i:0;a:2:{s:1:\"q\";s:31:\"How long does SEO take to work?\";s:1:\"a\";s:143:\"Most clients see momentum in 60–90 days, with step-change growth by month six. SEO compounds — the earlier you start, the bigger your lead.\";}i:1;a:2:{s:1:\"q\";s:29:\"Do you guarantee #1 rankings?\";s:1:\"a\";s:154:\"No reputable agency can guarantee a specific position. We guarantee a transparent, proven process and report on rankings, traffic and revenue every month.\";}}}i:2;a:12:{s:4:\"slug\";s:7:\"aeo-geo\";s:4:\"name\";s:39:\"Answer & Generative Engine Optimization\";s:5:\"short\";s:9:\"AEO / GEO\";s:4:\"icon\";s:5:\"spark\";s:8:\"featured\";b:0;s:7:\"tagline\";s:29:\"Get cited by AI, not skipped.\";s:4:\"desc\";s:103:\"We structure your brand so ChatGPT, Gemini, Perplexity and Google AI Overviews quote you as the answer.\";s:8:\"overview\";s:232:\"Search is moving inside AI. We optimize your brand so answer engines and generative AI — ChatGPT, Gemini, Perplexity and Google AI Overviews — cite you as the trusted answer, capturing demand your competitors can\'t even see yet.\";s:6:\"points\";a:4:{i:0;s:28:\"Schema & entity optimization\";i:1;s:27:\"Answer-first content design\";i:2;s:23:\"LLM citation monitoring\";i:3;s:33:\"Knowledge-graph & E-E-A-T signals\";}s:12:\"deliverables\";a:4:{i:0;a:2:{s:5:\"title\";s:24:\"Structured Data & Schema\";s:4:\"desc\";s:77:\"Entity, FAQ and product schema so machines understand exactly what you offer.\";}i:1;a:2:{s:5:\"title\";s:20:\"Answer-First Content\";s:4:\"desc\";s:76:\"Concise, citable content designed to be lifted into AI answers and snippets.\";}i:2;a:2:{s:5:\"title\";s:24:\"Entity & Knowledge Graph\";s:4:\"desc\";s:78:\"Consistent entity signals across the web that build machine trust and E-E-A-T.\";}i:3;a:2:{s:5:\"title\";s:22:\"AI Citation Monitoring\";s:4:\"desc\";s:66:\"We track where AI tools mention you and double down on what works.\";}}s:8:\"outcomes\";a:3:{i:0;s:41:\"Get cited inside AI answers and overviews\";i:1;s:39:\"Win featured snippets and voice results\";i:2;s:42:\"Capture demand before the click disappears\";}s:4:\"faqs\";a:2:{i:0;a:2:{s:1:\"q\";s:43:\"What is the difference between SEO and GEO?\";s:1:\"a\";s:158:\"SEO ranks pages in search results. GEO (Generative Engine Optimization) gets your brand quoted inside AI-generated answers. As AI search grows, you need both.\";}i:1;a:2:{s:1:\"q\";s:43:\"Can you really influence what ChatGPT says?\";s:1:\"a\";s:183:\"We can strongly influence it — through structured data, authoritative citable content and consistent entity signals that LLMs rely on — then monitor and iterate on real citations.\";}}}i:3;a:12:{s:4:\"slug\";s:3:\"aso\";s:4:\"name\";s:22:\"App Store Optimization\";s:5:\"short\";s:3:\"ASO\";s:4:\"icon\";s:6:\"mobile\";s:8:\"featured\";b:0;s:7:\"tagline\";s:30:\"More installs at a lower cost.\";s:4:\"desc\";s:108:\"Keyword-rich store listings, creative testing and rating strategy to lift App Store and Play Store rankings.\";s:8:\"overview\";s:200:\"Your app deserves to be found. We optimize every lever of your App Store and Google Play listing — keywords, creatives, ratings and conversion — to drive more installs at a lower cost per install.\";s:6:\"points\";a:4:{i:0;s:22:\"Store keyword research\";i:1;s:30:\"Listing & creative A/B testing\";i:2;s:28:\"Conversion-rate optimization\";i:3;s:24:\"Rating & review velocity\";}s:12:\"deliverables\";a:4:{i:0;a:2:{s:5:\"title\";s:22:\"Store Keyword Research\";s:4:\"desc\";s:73:\"Find the high-volume, winnable keywords your ideal users actually search.\";}i:1;a:2:{s:5:\"title\";s:20:\"Listing Optimization\";s:4:\"desc\";s:76:\"Title, subtitle, description and metadata tuned for rankings and conversion.\";}i:2;a:2:{s:5:\"title\";s:20:\"Creative A/B Testing\";s:4:\"desc\";s:69:\"Icon, screenshots and preview videos tested to maximise install rate.\";}i:3;a:2:{s:5:\"title\";s:17:\"Ratings & Reviews\";s:4:\"desc\";s:74:\"Strategies to grow rating velocity and respond to the reviews that matter.\";}}s:8:\"outcomes\";a:3:{i:0;s:35:\"Higher store rankings for key terms\";i:1;s:36:\"More organic installs at a lower CPI\";i:2;s:38:\"A better store-listing conversion rate\";}s:4:\"faqs\";a:2:{i:0;a:2:{s:1:\"q\";s:54:\"Do you optimize for both the App Store and Play Store?\";s:1:\"a\";s:119:\"Yes. We handle both the Apple App Store and Google Play, tailoring keywords and creatives to each platform\'s algorithm.\";}i:1;a:2:{s:1:\"q\";s:26:\"Is ASO a one-time project?\";s:1:\"a\";s:136:\"ASO works best as an ongoing program — store algorithms, competitors and trends shift constantly, so we test and iterate continuously.\";}}}i:4;a:12:{s:4:\"slug\";s:10:\"paid-media\";s:4:\"name\";s:21:\"Performance Marketing\";s:5:\"short\";s:10:\"Paid Media\";s:4:\"icon\";s:6:\"target\";s:8:\"featured\";b:0;s:7:\"tagline\";s:25:\"Profitable spend, scaled.\";s:4:\"desc\";s:90:\"Full-funnel Google, Meta and LinkedIn campaigns engineered around ROAS, not vanity clicks.\";s:8:\"overview\";s:208:\"Spend that pays you back. We build full-funnel paid campaigns on Google, Meta and LinkedIn around the one metric that matters — return on ad spend — with relentless creative testing and clean attribution.\";s:6:\"points\";a:4:{i:0;s:28:\"Google & Meta Ads management\";i:1;s:31:\"Creative & landing-page testing\";i:2;s:28:\"Tracking & attribution setup\";i:3;s:24:\"Budget scaling playbooks\";}s:12:\"deliverables\";a:4:{i:0;a:2:{s:5:\"title\";s:24:\"Strategy & Account Setup\";s:4:\"desc\";s:68:\"Account structure, audiences and bidding built for profitable scale.\";}i:1;a:2:{s:5:\"title\";s:24:\"Creative & Landing Tests\";s:4:\"desc\";s:68:\"Ad creative and landing-page experiments that lift conversion rates.\";}i:2;a:2:{s:5:\"title\";s:22:\"Tracking & Attribution\";s:4:\"desc\";s:65:\"Server-side tracking and analytics so you can trust every number.\";}i:3;a:2:{s:5:\"title\";s:17:\"Scaling Playbooks\";s:4:\"desc\";s:57:\"Systematic budget scaling that protects ROAS as you grow.\";}}s:8:\"outcomes\";a:3:{i:0;s:42:\"Higher ROAS and lower cost per acquisition\";i:1;s:43:\"Predictable, scalable lead and sales volume\";i:2;s:39:\"Clear attribution from click to revenue\";}s:4:\"faqs\";a:2:{i:0;a:2:{s:1:\"q\";s:44:\"What is the minimum ad budget you work with?\";s:1:\"a\";s:144:\"We typically start around $1k+ per month in ad spend, scaling to six figures. We\'ll recommend the right budget for your goals in the free audit.\";}i:1;a:2:{s:1:\"q\";s:32:\"Which ad platforms do you cover?\";s:1:\"a\";s:139:\"Google (Search, Performance Max, YouTube), Meta (Facebook & Instagram) and LinkedIn — chosen based on where your buyers actually convert.\";}}}i:5;a:12:{s:4:\"slug\";s:14:\"social-content\";s:4:\"name\";s:22:\"Social Media & Content\";s:5:\"short\";s:6:\"Social\";s:4:\"icon\";s:4:\"chat\";s:8:\"featured\";b:0;s:7:\"tagline\";s:31:\"Be the brand people screenshot.\";s:4:\"desc\";s:106:\"Thumb-stopping short-form content, community management and a calendar that keeps you culturally relevant.\";s:8:\"overview\";s:200:\"Attention is the new currency. We create thumb-stopping short-form content, run always-on community management and ship a consistent calendar that keeps your brand culturally relevant and top of mind.\";s:6:\"points\";a:4:{i:0;s:24:\"Short-form video & reels\";i:1;s:30:\"Always-on community management\";i:2;s:25:\"Influencer collaborations\";i:3;s:27:\"Content calendars that ship\";}s:12:\"deliverables\";a:4:{i:0;a:2:{s:5:\"title\";s:24:\"Short-Form Video & Reels\";s:4:\"desc\";s:68:\"Scroll-stopping reels, shorts and TikToks built for reach and saves.\";}i:1;a:2:{s:5:\"title\";s:16:\"Content Calendar\";s:4:\"desc\";s:68:\"A consistent, on-brand posting plan across the channels that matter.\";}i:2;a:2:{s:5:\"title\";s:20:\"Community Management\";s:4:\"desc\";s:66:\"Always-on engagement, DMs and comments that build loyal audiences.\";}i:3;a:2:{s:5:\"title\";s:25:\"Influencer Collaborations\";s:4:\"desc\";s:68:\"Creator partnerships that put your brand in front of warm audiences.\";}}s:8:\"outcomes\";a:3:{i:0;s:39:\"Grow a following that actually converts\";i:1;s:38:\"Stay culturally relevant and memorable\";i:2;s:43:\"Turn content into a reliable demand channel\";}s:4:\"faqs\";a:2:{i:0;a:2:{s:1:\"q\";s:37:\"Which social platforms do you manage?\";s:1:\"a\";s:110:\"Instagram, TikTok, LinkedIn, YouTube, Facebook and X — we focus on where your audience actually spends time.\";}i:1;a:2:{s:1:\"q\";s:46:\"Do you create the content or just schedule it?\";s:1:\"a\";s:138:\"Both. We script, shoot and edit short-form video, design creative, write copy and publish — a full content engine, not just a scheduler.\";}}}i:6;a:12:{s:4:\"slug\";s:10:\"web-design\";s:4:\"name\";s:24:\"Web Design & Development\";s:5:\"short\";s:3:\"Web\";s:4:\"icon\";s:4:\"code\";s:8:\"featured\";b:0;s:7:\"tagline\";s:24:\"Fast sites that convert.\";s:4:\"desc\";s:102:\"Conversion-first websites built on modern stacks — quick, accessible, and tuned for Core Web Vitals.\";s:8:\"overview\";s:190:\"Your website is your hardest-working salesperson. We design and build fast, accessible, conversion-first sites on modern stacks — tuned for Core Web Vitals and wired to measure everything.\";s:6:\"points\";a:4:{i:0;s:24:\"Conversion-focused UX/UI\";i:1;s:25:\"Headless & Laravel builds\";i:2;s:27:\"Core Web Vitals performance\";i:3;s:22:\"CRO & analytics wiring\";}s:12:\"deliverables\";a:4:{i:0;a:2:{s:5:\"title\";s:22:\"Conversion-First UX/UI\";s:4:\"desc\";s:63:\"Research-backed design that guides visitors smoothly to action.\";}i:1;a:2:{s:5:\"title\";s:18:\"Modern Development\";s:4:\"desc\";s:69:\"Laravel, headless and Jamstack builds that are fast and maintainable.\";}i:2;a:2:{s:5:\"title\";s:29:\"Performance & Core Web Vitals\";s:4:\"desc\";s:60:\"Sub-second loads that please users and search engines alike.\";}i:3;a:2:{s:5:\"title\";s:15:\"CRO & Analytics\";s:4:\"desc\";s:61:\"Tracking, A/B tests and heatmaps so the site keeps improving.\";}}s:8:\"outcomes\";a:3:{i:0;s:45:\"Higher conversion rates from the same traffic\";i:1;s:39:\"Faster loads and better Core Web Vitals\";i:2;s:39:\"A site that is easy to update and scale\";}s:4:\"faqs\";a:2:{i:0;a:2:{s:1:\"q\";s:32:\"What tech stack do you build on?\";s:1:\"a\";s:126:\"Modern, reliable stacks — Laravel + Livewire, headless CMS and Jamstack — chosen for speed, security and easy maintenance.\";}i:1;a:2:{s:1:\"q\";s:34:\"Can you redesign my existing site?\";s:1:\"a\";s:116:\"Absolutely. We can refresh or fully rebuild, migrating your content while preserving and usually improving your SEO.\";}}}}s:5:\"stats\";a:4:{i:0;a:3:{s:5:\"value\";i:320;s:6:\"suffix\";s:1:\"+\";s:5:\"label\";s:18:\"Campaigns launched\";}i:1;a:3:{s:5:\"value\";d:4.8;s:6:\"suffix\";s:1:\"x\";s:5:\"label\";s:19:\"Average client ROAS\";}i:2;a:3:{s:5:\"value\";i:98;s:6:\"suffix\";s:1:\"%\";s:5:\"label\";s:16:\"Client retention\";}i:3;a:3:{s:5:\"value\";i:65;s:6:\"suffix\";s:1:\"+\";s:5:\"label\";s:13:\"Brands scaled\";}}s:7:\"process\";a:4:{i:0;a:3:{s:2:\"no\";s:2:\"01\";s:5:\"title\";s:16:\"Audit & Discover\";s:4:\"desc\";s:90:\"We benchmark your funnel, competitors and search/AI visibility to find the fastest levers.\";}i:1;a:3:{s:2:\"no\";s:2:\"02\";s:5:\"title\";s:18:\"Strategy & Roadmap\";s:4:\"desc\";s:81:\"A prioritized, channel-by-channel growth roadmap mapped to clear revenue targets.\";}i:2;a:3:{s:2:\"no\";s:2:\"03\";s:5:\"title\";s:16:\"Execute & Launch\";s:4:\"desc\";s:80:\"Our specialists ship content, campaigns and code — fast, with weekly momentum.\";}i:3;a:3:{s:2:\"no\";s:2:\"04\";s:5:\"title\";s:15:\"Measure & Scale\";s:4:\"desc\";s:76:\"Transparent dashboards, relentless testing, and reinvestment into what wins.\";}}s:12:\"testimonials\";a:3:{i:0;a:3:{s:5:\"quote\";s:104:\"Pantheraa Space took us from invisible to page one in two quarters. Organic now drives 60% of our demos.\";s:4:\"name\";s:11:\"Aarav Mehta\";s:4:\"role\";s:21:\"Founder, FinFlow SaaS\";}i:1;a:3:{s:5:\"quote\";s:117:\"They are the first agency that actually understood AI search. We now show up inside ChatGPT answers for our category.\";s:4:\"name\";s:9:\"Sara Khan\";s:4:\"role\";s:19:\"CMO, Lumen Skincare\";}i:2;a:3:{s:5:\"quote\";s:99:\"ROAS jumped from 1.9x to 5.3x in 90 days. Reporting is brutally honest and the team feels in-house.\";s:4:\"name\";s:14:\"Daniel Roberts\";s:4:\"role\";s:27:\"Growth Lead, Vault Commerce\";}}s:4:\"faqs\";a:7:{i:0;a:2:{s:1:\"q\";s:70:\"What does a digital marketing agency like Pantheraa Space actually do?\";s:1:\"a\";s:220:\"Pantheraa Space is a full-service digital marketing agency. We plan and execute SEO, AEO/GEO (AI-search), ASO, paid media, social content and high-converting websites — all measured against revenue, not vanity metrics.\";}i:1;a:2:{s:1:\"q\";s:48:\"What is the difference between SEO, AEO and GEO?\";s:1:\"a\";s:273:\"SEO ranks you in classic search results. AEO (Answer Engine Optimization) gets you into featured answers and voice results. GEO (Generative Engine Optimization) makes AI tools like ChatGPT, Gemini and Google AI Overviews cite your brand. We optimize for all three together.\";}i:2;a:2:{s:1:\"q\";s:53:\"Do you build AI chatbots, agents and custom AI tools?\";s:1:\"a\";s:295:\"Yes. Beyond marketing, Pantheraa Space builds AI products: customer-support and lead-gen chatbots, autonomous AI agents, custom copilots and RAG tools trained on your own data, plus workflow automation that connects your existing stack. We can deploy on your website, WhatsApp or internal tools.\";}i:3;a:2:{s:1:\"q\";s:28:\"How soon will I see results?\";s:1:\"a\";s:177:\"Paid media and ASO can move within weeks. SEO, AEO and GEO are compounding channels — most clients see meaningful momentum in 60–90 days and step-change growth by month six.\";}i:4;a:2:{s:1:\"q\";s:47:\"Do you work with startups and small businesses?\";s:1:\"a\";s:153:\"Yes. We run engagements from focused single-channel sprints for early-stage startups up to full-funnel growth retainers for funded and enterprise brands.\";}i:5;a:2:{s:1:\"q\";s:33:\"How do you report on performance?\";s:1:\"a\";s:158:\"Every client gets a live dashboard plus a monthly review call. We report on pipeline, revenue and ROAS — the numbers that matter — with full transparency.\";}i:6;a:2:{s:1:\"q\";s:22:\"How do we get started?\";s:1:\"a\";s:137:\"Send us your goals through the contact form and we will reply within one business day with a free growth audit and a recommended roadmap.\";}}s:5:\"cases\";a:3:{i:0;a:6:{s:6:\"client\";s:12:\"FinFlow SaaS\";s:8:\"industry\";s:8:\"B2B SaaS\";s:6:\"metric\";s:5:\"+312%\";s:3:\"kpi\";s:13:\"organic demos\";s:4:\"desc\";s:86:\"Topic-cluster SEO + AEO turned organic search into the #1 demo source in two quarters.\";s:4:\"tags\";a:2:{i:0;s:3:\"SEO\";i:1;s:3:\"AEO\";}}i:1;a:6:{s:6:\"client\";s:14:\"Lumen Skincare\";s:8:\"industry\";s:10:\"D2C Beauty\";s:6:\"metric\";s:4:\"5.3x\";s:3:\"kpi\";s:12:\"blended ROAS\";s:4:\"desc\";s:81:\"Creative-led Meta & Google scaling lifted ROAS from 1.9x to 5.3x at 4x the spend.\";s:4:\"tags\";a:2:{i:0;s:10:\"Paid Media\";i:1;s:6:\"Social\";}}i:2;a:6:{s:6:\"client\";s:14:\"Vault Commerce\";s:8:\"industry\";s:11:\"Marketplace\";s:6:\"metric\";s:2:\"#1\";s:3:\"kpi\";s:13:\"in AI answers\";s:4:\"desc\";s:85:\"GEO + schema work earned consistent citations inside ChatGPT and Google AI Overviews.\";s:4:\"tags\";a:2:{i:0;s:3:\"GEO\";i:1;s:3:\"Web\";}}}}',2097135905);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `case_studies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `case_studies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client` varchar(255) NOT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `metric` varchar(255) DEFAULT NULL,
  `kpi` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tags`)),
  `sort` int(10) unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `case_studies` WRITE;
/*!40000 ALTER TABLE `case_studies` DISABLE KEYS */;
INSERT INTO `case_studies` VALUES (1,'FinFlow SaaS','B2B SaaS','+312%','organic demos','Topic-cluster SEO + AEO turned organic search into the #1 demo source in two quarters.','[\"SEO\",\"AEO\"]',0,1,'2026-06-18 00:13:23','2026-06-18 00:13:23'),(2,'Lumen Skincare','D2C Beauty','5.3x','blended ROAS','Creative-led Meta & Google scaling lifted ROAS from 1.9x to 5.3x at 4x the spend.','[\"Paid Media\",\"Social\"]',1,1,'2026-06-18 00:13:23','2026-06-18 00:13:23'),(3,'Vault Commerce','Marketplace','#1','in AI answers','GEO + schema work earned consistent citations inside ChatGPT and Google AI Overviews.','[\"GEO\",\"Web\"]',2,1,'2026-06-18 00:13:23','2026-06-18 00:13:23');
/*!40000 ALTER TABLE `case_studies` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `budget` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'new',
  `ip` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faqs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,'What does a digital marketing agency like Pantheraa Space actually do?','Pantheraa Space is a full-service digital marketing agency. We plan and execute SEO, AEO/GEO (AI-search), ASO, paid media, social content and high-converting websites — all measured against revenue, not vanity metrics.',0,1,'2026-06-18 00:13:23','2026-06-18 00:13:23'),(2,'What is the difference between SEO, AEO and GEO?','SEO ranks you in classic search results. AEO (Answer Engine Optimization) gets you into featured answers and voice results. GEO (Generative Engine Optimization) makes AI tools like ChatGPT, Gemini and Google AI Overviews cite your brand. We optimize for all three together.',1,1,'2026-06-18 00:13:23','2026-06-18 00:13:23'),(3,'Do you build AI chatbots, agents and custom AI tools?','Yes. Beyond marketing, Pantheraa Space builds AI products: customer-support and lead-gen chatbots, autonomous AI agents, custom copilots and RAG tools trained on your own data, plus workflow automation that connects your existing stack. We can deploy on your website, WhatsApp or internal tools.',2,1,'2026-06-18 00:13:23','2026-06-18 00:13:23'),(4,'How soon will I see results?','Paid media and ASO can move within weeks. SEO, AEO and GEO are compounding channels — most clients see meaningful momentum in 60–90 days and step-change growth by month six.',3,1,'2026-06-18 00:13:23','2026-06-18 00:13:23'),(5,'Do you work with startups and small businesses?','Yes. We run engagements from focused single-channel sprints for early-stage startups up to full-funnel growth retainers for funded and enterprise brands.',4,1,'2026-06-18 00:13:23','2026-06-18 00:13:23'),(6,'How do you report on performance?','Every client gets a live dashboard plus a monthly review call. We report on pipeline, revenue and ROAS — the numbers that matter — with full transparency.',5,1,'2026-06-18 00:13:23','2026-06-18 00:13:23'),(7,'How do we get started?','Send us your goals through the contact form and we will reply within one business day with a free growth audit and a recommended roadmap.',6,1,'2026-06-18 00:13:23','2026-06-18 00:13:23');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `learning_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `learning_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `learning_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `learning_categories` WRITE;
/*!40000 ALTER TABLE `learning_categories` DISABLE KEYS */;
INSERT INTO `learning_categories` VALUES (1,'AI News','ai-news',NULL,0,1,'2026-06-18 00:13:24','2026-06-18 00:13:24'),(2,'LLMs','llms',NULL,1,1,'2026-06-18 00:13:24','2026-06-18 00:13:24'),(3,'RAG','rag',NULL,2,1,'2026-06-18 00:13:24','2026-06-18 00:13:24'),(4,'Prompting','prompting',NULL,3,1,'2026-06-18 00:13:24','2026-06-18 00:13:24'),(5,'Agents','agents',NULL,4,1,'2026-06-18 00:13:24','2026-06-18 00:13:24'),(6,'Machine Learning','machine-learning',NULL,5,1,'2026-06-18 00:13:24','2026-06-18 00:13:24'),(7,'Code','code',NULL,6,1,'2026-06-18 00:13:24','2026-06-18 00:13:24'),(8,'Math','math',NULL,7,1,'2026-06-18 00:13:24','2026-06-18 00:13:24'),(9,'Essay','essay',NULL,8,1,'2026-06-18 00:13:24','2026-06-18 00:13:24'),(10,'Tools','tools',NULL,9,1,'2026-06-18 00:13:24','2026-06-18 00:13:24');
/*!40000 ALTER TABLE `learning_categories` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `learnings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `learnings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `body` longtext NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tags`)),
  `cover_path` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `noindex` tinyint(1) NOT NULL DEFAULT 0,
  `canonical` varchar(255) DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `views` bigint(20) unsigned NOT NULL DEFAULT 0,
  `reading_minutes` int(10) unsigned NOT NULL DEFAULT 1,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(320) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `learnings_slug_unique` (`slug`),
  KEY `learnings_status_published_at_index` (`status`,`published_at`),
  KEY `learnings_category_id_foreign` (`category_id`),
  CONSTRAINT `learnings_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `learning_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `learnings` WRITE;
/*!40000 ALTER TABLE `learnings` DISABLE KEYS */;
INSERT INTO `learnings` VALUES (1,'How RAG actually works (with code)','how-rag-actually-works-with-code','Retrieval-Augmented Generation grounds an LLM in your own data. The core loop in four steps — plus a tiny Python retriever.','RAG (Retrieval-Augmented Generation) grounds an LLM in **your own data** instead of relying only on what it memorized during training.\n\n## The core idea\n\n1. **Embed** your documents into vectors.\n2. **Retrieve** the most similar chunks for a query.\n3. **Augment** the prompt with those chunks.\n4. **Generate** an answer grounded in them.\n\nSimilarity is usually cosine similarity between embeddings:\n\n$$ \\text{sim}(a, b) = \\frac{a \\cdot b}{\\lVert a \\rVert \\, \\lVert b \\rVert} $$\n\nHere\'s a minimal retrieval loop in Python:\n\n```python\nimport numpy as np\n\ndef cosine(a, b):\n    return a @ b / (np.linalg.norm(a) * np.linalg.norm(b))\n\ndef retrieve(query_vec, docs, k=3):\n    scored = [(cosine(query_vec, d[\"vec\"]), d) for d in docs]\n    scored.sort(key=lambda x: x[0], reverse=True)\n    return [d for _, d in scored[:k]]\n```\n\nThe retrieved chunks get stuffed into the context window before generation. Simple — but it changes everything.','RAG',NULL,'[\"rag\",\"embeddings\",\"vector-db\"]',NULL,'published',0,NULL,'2026-06-18 00:13:25',0,1,NULL,NULL,'2026-06-18 00:13:25','2026-06-18 00:13:25',NULL),(2,'The math behind transformer attention','the-math-behind-transformer-attention','Scaled dot-product attention in one formula, why the √dₖ scaling matters, and a tiny PyTorch sketch.','The heart of a transformer is **scaled dot-product attention**. Given queries $Q$, keys $K$ and values $V$:\n\n$$ \\text{Attention}(Q, K, V) = \\text{softmax}\\!\\left( \\frac{QK^\\top}{\\sqrt{d_k}} \\right) V $$\n\nThe $\\sqrt{d_k}$ scaling stops the dot products from growing too large, which would push softmax into regions with vanishing gradients.\n\nSoftmax for a vector $z$ is:\n\n$$ \\sigma(z)_i = \\frac{e^{z_i}}{\\sum_j e^{z_j}} $$\n\nA tiny PyTorch sketch:\n\n```python\nimport torch\nimport torch.nn.functional as F\n\ndef attention(q, k, v):\n    d_k = q.size(-1)\n    scores = q @ k.transpose(-2, -1) / d_k ** 0.5\n    weights = F.softmax(scores, dim=-1)\n    return weights @ v\n```\n\nOnce you see attention as a soft, differentiable lookup table, the rest of the architecture clicks into place.','LLMs',NULL,'[\"transformers\",\"attention\",\"math\"]',NULL,'published',0,NULL,'2026-06-17 00:13:25',1,1,NULL,NULL,'2026-06-18 00:13:25','2026-06-18 04:15:07',NULL),(3,'What actually mattered in AI this week','what-actually-mattered-in-ai-this-week','Longer context, on-device models and dependable agents — the signals worth paying attention to.','Every week the frontier moves. Here\'s what actually mattered to me this week — and why.\n\n> The best way to keep up is not to read everything. It\'s to **build** something with each new capability.\n\n- **Longer context windows** are quietly changing how we design RAG.\n- **On-device models** are getting genuinely useful for private workloads.\n- **Agents** are moving from flashy demos to dependable workflows.\n\nI\'ll keep sharing the experiments here as I run them. 🐾','AI News',NULL,'[\"ai-news\",\"agents\"]',NULL,'published',0,NULL,'2026-06-16 00:13:25',0,1,NULL,NULL,'2026-06-18 00:13:25','2026-06-18 00:13:25',NULL);
/*!40000 ALTER TABLE `learnings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_06_17_185846_create_contacts_table',1),(5,'2026_06_17_185847_create_subscribers_table',1),(6,'2026_06_17_231737_create_learnings_table',1),(7,'2026_06_18_024126_create_cms_tables',1),(8,'2026_06_18_030000_create_seo_and_category_tables',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `process_steps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `process_steps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `no` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `process_steps` WRITE;
/*!40000 ALTER TABLE `process_steps` DISABLE KEYS */;
INSERT INTO `process_steps` VALUES (1,'01','Audit & Discover','We benchmark your funnel, competitors and search/AI visibility to find the fastest levers.',0,1,'2026-06-18 00:13:23','2026-06-18 00:13:23'),(2,'02','Strategy & Roadmap','A prioritized, channel-by-channel growth roadmap mapped to clear revenue targets.',1,1,'2026-06-18 00:13:23','2026-06-18 00:13:23'),(3,'03','Execute & Launch','Our specialists ship content, campaigns and code — fast, with weekly momentum.',2,1,'2026-06-18 00:13:23','2026-06-18 00:13:23'),(4,'04','Measure & Scale','Transparent dashboards, relentless testing, and reinvestment into what wins.',3,1,'2026-06-18 00:13:23','2026-06-18 00:13:23');
/*!40000 ALTER TABLE `process_steps` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `redirects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `redirects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `source` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `status_code` smallint(5) unsigned NOT NULL DEFAULT 301,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `hits` bigint(20) unsigned NOT NULL DEFAULT 0,
  `last_hit_at` timestamp NULL DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `redirects_source_unique` (`source`),
  KEY `redirects_is_active_index` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `redirects` WRITE;
/*!40000 ALTER TABLE `redirects` DISABLE KEYS */;
/*!40000 ALTER TABLE `redirects` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `schema_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schema_entries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'Custom',
  `placement` varchar(255) NOT NULL DEFAULT 'all',
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schema_entries_is_active_placement_index` (`is_active`,`placement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `schema_entries` WRITE;
/*!40000 ALTER TABLE `schema_entries` DISABLE KEYS */;
/*!40000 ALTER TABLE `schema_entries` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short` varchar(255) DEFAULT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'spark',
  `tagline` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `overview` varchar(1000) DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `points` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`points`)),
  `deliverables` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`deliverables`)),
  `outcomes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`outcomes`)),
  `faqs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`faqs`)),
  `sort` int(10) unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(320) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'ai-solutions','AI Solutions & Automation','AI','bot','Chatbots, agents & custom AI that work for you.','We design and build AI chatbots, autonomous agents and custom AI tools — trained on your own data to automate support, sales and operations.','We don\'t just talk about AI — we ship it. From customer-facing chatbots to autonomous agents and internal copilots, we design, build and deploy AI systems trained on your own data so they truly understand your business and move real numbers.',1,'[\"AI chatbots & support assistants\",\"Autonomous & workflow AI agents\",\"Custom AI tools, copilots & RAG\",\"Process & workflow automation\"]','[{\"title\":\"AI Chatbots & Assistants\",\"desc\":\"24\\/7 web, WhatsApp and in-app bots that answer questions, qualify leads and book meetings.\"},{\"title\":\"Autonomous AI Agents\",\"desc\":\"Multi-step agents that research, draft, decide and complete tasks across your tools.\"},{\"title\":\"Custom Copilots & RAG\",\"desc\":\"Private assistants trained on your docs and brand voice \\u2014 answers you can actually trust.\"},{\"title\":\"Workflow Automation\",\"desc\":\"We connect your CRM, email, sheets and apps so repetitive work runs itself.\"}]','[\"Cut response times from hours to seconds\",\"Capture and qualify leads around the clock\",\"Free your team from repetitive busywork\"]','[{\"q\":\"Will the AI be trained on my business data?\",\"a\":\"Yes. We use retrieval-augmented generation (RAG) and fine-tuning so the AI answers from your documents, products and policies \\u2014 not generic internet guesses.\"},{\"q\":\"Where can the chatbot be deployed?\",\"a\":\"Anywhere your customers are \\u2014 your website, WhatsApp, Instagram and Messenger, or as an internal tool for your team.\"}]',0,1,'2026-06-18 00:13:23','2026-06-18 00:13:23',NULL,NULL),(2,'seo','Search Engine Optimization','SEO','search','Own page one for the keywords that pay.','Technical SEO, topical authority and link acquisition that compounds organic traffic into qualified pipeline.','Sustainable organic growth, engineered. We fix the technical foundation, build topical authority and earn the links that move you up the rankings — turning search into your most profitable, compounding channel.',0,'[\"Technical & Core Web Vitals audits\",\"Topic-cluster content strategy\",\"Authority link building\",\"Local & Google Business Profile SEO\"]','[{\"title\":\"Technical SEO Audit\",\"desc\":\"Crawl, indexation, speed and Core Web Vitals fixes that unlock rankings.\"},{\"title\":\"Content & Topic Clusters\",\"desc\":\"A keyword-mapped content plan that builds authority around what you sell.\"},{\"title\":\"Authority Link Building\",\"desc\":\"White-hat digital PR and outreach that earns links search engines trust.\"},{\"title\":\"Local SEO\",\"desc\":\"Google Business Profile, citations and reviews to win the local map pack.\"}]','[\"Higher rankings for high-intent keywords\",\"Compounding organic traffic that lowers CAC\",\"More qualified leads without paying per click\"]','[{\"q\":\"How long does SEO take to work?\",\"a\":\"Most clients see momentum in 60\\u201390 days, with step-change growth by month six. SEO compounds \\u2014 the earlier you start, the bigger your lead.\"},{\"q\":\"Do you guarantee #1 rankings?\",\"a\":\"No reputable agency can guarantee a specific position. We guarantee a transparent, proven process and report on rankings, traffic and revenue every month.\"}]',1,1,'2026-06-18 00:13:23','2026-06-18 00:13:23',NULL,NULL),(3,'aeo-geo','Answer & Generative Engine Optimization','AEO / GEO','spark','Get cited by AI, not skipped.','We structure your brand so ChatGPT, Gemini, Perplexity and Google AI Overviews quote you as the answer.','Search is moving inside AI. We optimize your brand so answer engines and generative AI — ChatGPT, Gemini, Perplexity and Google AI Overviews — cite you as the trusted answer, capturing demand your competitors can\'t even see yet.',0,'[\"Schema & entity optimization\",\"Answer-first content design\",\"LLM citation monitoring\",\"Knowledge-graph & E-E-A-T signals\"]','[{\"title\":\"Structured Data & Schema\",\"desc\":\"Entity, FAQ and product schema so machines understand exactly what you offer.\"},{\"title\":\"Answer-First Content\",\"desc\":\"Concise, citable content designed to be lifted into AI answers and snippets.\"},{\"title\":\"Entity & Knowledge Graph\",\"desc\":\"Consistent entity signals across the web that build machine trust and E-E-A-T.\"},{\"title\":\"AI Citation Monitoring\",\"desc\":\"We track where AI tools mention you and double down on what works.\"}]','[\"Get cited inside AI answers and overviews\",\"Win featured snippets and voice results\",\"Capture demand before the click disappears\"]','[{\"q\":\"What is the difference between SEO and GEO?\",\"a\":\"SEO ranks pages in search results. GEO (Generative Engine Optimization) gets your brand quoted inside AI-generated answers. As AI search grows, you need both.\"},{\"q\":\"Can you really influence what ChatGPT says?\",\"a\":\"We can strongly influence it \\u2014 through structured data, authoritative citable content and consistent entity signals that LLMs rely on \\u2014 then monitor and iterate on real citations.\"}]',2,1,'2026-06-18 00:13:23','2026-06-18 00:13:23',NULL,NULL),(4,'aso','App Store Optimization','ASO','mobile','More installs at a lower cost.','Keyword-rich store listings, creative testing and rating strategy to lift App Store and Play Store rankings.','Your app deserves to be found. We optimize every lever of your App Store and Google Play listing — keywords, creatives, ratings and conversion — to drive more installs at a lower cost per install.',0,'[\"Store keyword research\",\"Listing & creative A\\/B testing\",\"Conversion-rate optimization\",\"Rating & review velocity\"]','[{\"title\":\"Store Keyword Research\",\"desc\":\"Find the high-volume, winnable keywords your ideal users actually search.\"},{\"title\":\"Listing Optimization\",\"desc\":\"Title, subtitle, description and metadata tuned for rankings and conversion.\"},{\"title\":\"Creative A\\/B Testing\",\"desc\":\"Icon, screenshots and preview videos tested to maximise install rate.\"},{\"title\":\"Ratings & Reviews\",\"desc\":\"Strategies to grow rating velocity and respond to the reviews that matter.\"}]','[\"Higher store rankings for key terms\",\"More organic installs at a lower CPI\",\"A better store-listing conversion rate\"]','[{\"q\":\"Do you optimize for both the App Store and Play Store?\",\"a\":\"Yes. We handle both the Apple App Store and Google Play, tailoring keywords and creatives to each platform\'s algorithm.\"},{\"q\":\"Is ASO a one-time project?\",\"a\":\"ASO works best as an ongoing program \\u2014 store algorithms, competitors and trends shift constantly, so we test and iterate continuously.\"}]',3,1,'2026-06-18 00:13:23','2026-06-18 00:13:23',NULL,NULL),(5,'paid-media','Performance Marketing','Paid Media','target','Profitable spend, scaled.','Full-funnel Google, Meta and LinkedIn campaigns engineered around ROAS, not vanity clicks.','Spend that pays you back. We build full-funnel paid campaigns on Google, Meta and LinkedIn around the one metric that matters — return on ad spend — with relentless creative testing and clean attribution.',0,'[\"Google & Meta Ads management\",\"Creative & landing-page testing\",\"Tracking & attribution setup\",\"Budget scaling playbooks\"]','[{\"title\":\"Strategy & Account Setup\",\"desc\":\"Account structure, audiences and bidding built for profitable scale.\"},{\"title\":\"Creative & Landing Tests\",\"desc\":\"Ad creative and landing-page experiments that lift conversion rates.\"},{\"title\":\"Tracking & Attribution\",\"desc\":\"Server-side tracking and analytics so you can trust every number.\"},{\"title\":\"Scaling Playbooks\",\"desc\":\"Systematic budget scaling that protects ROAS as you grow.\"}]','[\"Higher ROAS and lower cost per acquisition\",\"Predictable, scalable lead and sales volume\",\"Clear attribution from click to revenue\"]','[{\"q\":\"What is the minimum ad budget you work with?\",\"a\":\"We typically start around $1k+ per month in ad spend, scaling to six figures. We\'ll recommend the right budget for your goals in the free audit.\"},{\"q\":\"Which ad platforms do you cover?\",\"a\":\"Google (Search, Performance Max, YouTube), Meta (Facebook & Instagram) and LinkedIn \\u2014 chosen based on where your buyers actually convert.\"}]',4,1,'2026-06-18 00:13:23','2026-06-18 00:13:23',NULL,NULL),(6,'social-content','Social Media & Content','Social','chat','Be the brand people screenshot.','Thumb-stopping short-form content, community management and a calendar that keeps you culturally relevant.','Attention is the new currency. We create thumb-stopping short-form content, run always-on community management and ship a consistent calendar that keeps your brand culturally relevant and top of mind.',0,'[\"Short-form video & reels\",\"Always-on community management\",\"Influencer collaborations\",\"Content calendars that ship\"]','[{\"title\":\"Short-Form Video & Reels\",\"desc\":\"Scroll-stopping reels, shorts and TikToks built for reach and saves.\"},{\"title\":\"Content Calendar\",\"desc\":\"A consistent, on-brand posting plan across the channels that matter.\"},{\"title\":\"Community Management\",\"desc\":\"Always-on engagement, DMs and comments that build loyal audiences.\"},{\"title\":\"Influencer Collaborations\",\"desc\":\"Creator partnerships that put your brand in front of warm audiences.\"}]','[\"Grow a following that actually converts\",\"Stay culturally relevant and memorable\",\"Turn content into a reliable demand channel\"]','[{\"q\":\"Which social platforms do you manage?\",\"a\":\"Instagram, TikTok, LinkedIn, YouTube, Facebook and X \\u2014 we focus on where your audience actually spends time.\"},{\"q\":\"Do you create the content or just schedule it?\",\"a\":\"Both. We script, shoot and edit short-form video, design creative, write copy and publish \\u2014 a full content engine, not just a scheduler.\"}]',5,1,'2026-06-18 00:13:23','2026-06-18 00:13:23',NULL,NULL),(7,'web-design','Web Design & Development','Web','code','Fast sites that convert.','Conversion-first websites built on modern stacks — quick, accessible, and tuned for Core Web Vitals.','Your website is your hardest-working salesperson. We design and build fast, accessible, conversion-first sites on modern stacks — tuned for Core Web Vitals and wired to measure everything.',0,'[\"Conversion-focused UX\\/UI\",\"Headless & Laravel builds\",\"Core Web Vitals performance\",\"CRO & analytics wiring\"]','[{\"title\":\"Conversion-First UX\\/UI\",\"desc\":\"Research-backed design that guides visitors smoothly to action.\"},{\"title\":\"Modern Development\",\"desc\":\"Laravel, headless and Jamstack builds that are fast and maintainable.\"},{\"title\":\"Performance & Core Web Vitals\",\"desc\":\"Sub-second loads that please users and search engines alike.\"},{\"title\":\"CRO & Analytics\",\"desc\":\"Tracking, A\\/B tests and heatmaps so the site keeps improving.\"}]','[\"Higher conversion rates from the same traffic\",\"Faster loads and better Core Web Vitals\",\"A site that is easy to update and scale\"]','[{\"q\":\"What tech stack do you build on?\",\"a\":\"Modern, reliable stacks \\u2014 Laravel + Livewire, headless CMS and Jamstack \\u2014 chosen for speed, security and easy maintenance.\"},{\"q\":\"Can you redesign my existing site?\",\"a\":\"Absolutely. We can refresh or fully rebuild, migrating your content while preserving and usually improving your SEO.\"}]',6,1,'2026-06-18 00:13:23','2026-06-18 00:13:23',NULL,NULL);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('16j6e5n4dhFHm17qkWOR2E21xVqGbLQeFj6k5fmA',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-IN) WindowsPowerShell/5.1.26100.8655','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYnloNWNKOXg3YWlrUjF4VGc1MllTSkViUUcxTzU0eEozVm00R244VCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zZXJ2aWNlcy9haS1zb2x1dGlvbnMiO3M6NToicm91dGUiO3M6MTM6InNlcnZpY2VzLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781775906),('16xIOJiBH9DJDPZ8nNCup7eeNnHkVEKE0m1MDacI',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-IN) WindowsPowerShell/5.1.26100.8655','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQmI1MlB1TjZQQzZkSDNmQzZRMkdQTkNQVmZRVVc2TVdqdmlRWUd5NSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Njk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sZWFybmluZ3MvdGhlLW1hdGgtYmVoaW5kLXRyYW5zZm9ybWVyLWF0dGVudGlvbiI7czo1OiJyb3V0ZSI7czoxNDoibGVhcm5pbmdzLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781775907),('992vEIREOmbVLmCsNAESdUzDYnmsuJKvUhrLmOrA',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-IN) WindowsPowerShell/5.1.26100.8655','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRFk1OGdkM0JpUFhPejZqbzlHSloxYUw0RzZPMGprN29lYVFuYng3WCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9hZG1pbi9sb2dpbiI7czo1OiJyb3V0ZSI7czoxMToiYWRtaW4ubG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781761461),('HGFBW7nOXSbPQofHctJM8n5iNdp3URwPoPmrpVOL',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-IN) WindowsPowerShell/5.1.26100.8655','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZXpDelVPc0xnZllOQTdJVlJFMnlyZkNGRnJZUVRuVlFQNHVUR2Y5eCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sZWFybmluZ3MiO3M6NToicm91dGUiO3M6OToibGVhcm5pbmdzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781775907),('kaIoa3mCforUhWfC6jZy8hrxLjdHtC9gRhuTCQw2',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-IN) WindowsPowerShell/5.1.26100.8655','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTjl5MVZ6VEFGR2ZsQWJxd25hSUZIZjA4VjVVZXNaTURMdFA2WDFDTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781775905),('lKH2bNg0W8Shj7YAVHkN1EMDAYgoK4X0PO7tLxrM',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-IN) WindowsPowerShell/5.1.26100.8655','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZFJvN3hXb2lVb3N3VlUyUzZXc1k0dVdhaVI2RFZGYzR3TGJwWHhQcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7czo1OiJyb3V0ZSI7czoxMToiYWRtaW4ubG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781775908),('m5OdeLAdisXXbYQ3gTHFQMkuaatPtH57Biwl380c',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-IN) WindowsPowerShell/5.1.26100.8655','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRGZoTGNQdE00N2dLMEFtZXc1eEpSbWJ0bnc0ZHMyZ21YR2x1WWtNTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781761459),('MjMdFYFsm0TQK9sTENK6yY5EMJSSAZX0QEv5CP1s',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-IN) WindowsPowerShell/5.1.26100.8655','YTozOntzOjY6Il90b2tlbiI7czo0MDoia3lETnhZU0dvaDMwZlFaanFObnp4TUkwMFhZT2NoVjFzVXJLdWhPZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaXRlbWFwLnhtbCI7czo1OiJyb3V0ZSI7czo3OiJzaXRlbWFwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781775908),('PJuxP04NMkJDXD7gKGn96lvJzwfBdJOKJGkwB4U4',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-IN) WindowsPowerShell/5.1.26100.8655','YTozOntzOjY6Il90b2tlbiI7czo0MDoiM3gwV0R4eEZtd2hST0JLYld3aUhwMWI0S3B5VlVCbVd0NkFPcUQ2cyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9sZWFybmluZ3MiO3M6NToicm91dGUiO3M6OToibGVhcm5pbmdzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781761460),('u7poOmWnyvCu7sp4y2mwAMUXTu111REA6RFr508f',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-IN) WindowsPowerShell/5.1.26100.8655','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ1l2STczNEtNSktFcDV3ZUNFeXNxd1V2Y01tVHYwcngxZUdWamtrciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781775909),('urn7M0JkOsLzZVCCJhK0QjpDGfHvglpdDhgues1U',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-IN) WindowsPowerShell/5.1.26100.8655','YTozOntzOjY6Il90b2tlbiI7czo0MDoid2FRNFdEOUdvTWdTaFY4NXppdENVQWc5M0VFallwcnl4Rk1PRmt4WSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9zZXJ2aWNlcy9haS1zb2x1dGlvbnMiO3M6NToicm91dGUiO3M6MTM6InNlcnZpY2VzLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781761460),('W8WqewlWXfgdKu4qJ1JU6APRAVvFugEY20v9s8pp',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-IN) WindowsPowerShell/5.1.26100.8655','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVUhoZGpmd3pvOEcxZEwzR0ZaSkdpOW4xVTdkVGE5UFd3cE5ubjcyOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yb2JvdHMudHh0IjtzOjU6InJvdXRlIjtzOjY6InJvYm90cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781775908),('XzIbhPUwPvW757o2zPqpuuPddqtNYVuzrDjlZubV',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-IN) WindowsPowerShell/5.1.26100.8655','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTFd2TzRUaG1leFVoZ3ZHUFI5Y0NEc1plaTZpNmxrOXFNeXNHUXppbiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781775906),('ynbjXsRXp0lboUeHRCsVlEoqkvthCz3yH8BUelOP',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.125.0 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ2pUc045U1BLblF1VjNMNXQxelJEV3R6OHBIOUNDMmtndHdQVEY3biI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781761619);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`value`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'name','\"Pantheraa Space\"','2026-06-18 00:13:23','2026-06-18 00:13:23'),(2,'tagline','\"Digital Panther\"','2026-06-18 00:13:23','2026-06-18 00:13:23'),(3,'legal_name','\"Pantheraa Space\"','2026-06-18 00:13:23','2026-06-18 00:13:23'),(4,'short_desc','\"A performance-driven digital marketing agency engineering SEO, AEO, GEO & ASO growth for ambitious brands.\"','2026-06-18 00:13:23','2026-06-18 00:13:23'),(5,'founded','\"2019\"','2026-06-18 00:13:23','2026-06-18 00:13:23'),(6,'email','\"techteam@icg-seo.com\"','2026-06-18 00:13:23','2026-06-18 00:13:23'),(7,'phone','\"+91 98765 43210\"','2026-06-18 00:13:23','2026-06-18 00:13:23'),(8,'phone_link','\"+919876543210\"','2026-06-18 00:13:23','2026-06-18 00:13:23'),(9,'hours','\"Mo-Sa 10:00-19:00\"','2026-06-18 00:13:23','2026-06-18 00:13:23'),(10,'price_range','\"\\u20b9\\u20b9\"','2026-06-18 00:13:23','2026-06-18 00:13:23'),(11,'address','{\"street\":\"4th Floor, Cyber Hub Tower\",\"locality\":\"New Delhi\",\"region\":\"Delhi\",\"postal\":\"110001\",\"country\":\"IN\"}','2026-06-18 00:13:23','2026-06-18 00:13:23'),(12,'geo','{\"lat\":28.6139,\"lng\":77.209}','2026-06-18 00:13:23','2026-06-18 00:13:23'),(13,'social','{\"linkedin\":\"https:\\/\\/www.linkedin.com\\/company\\/pantheraa-space\",\"instagram\":\"https:\\/\\/www.instagram.com\\/pantheraa.space\",\"x\":\"https:\\/\\/x.com\\/pantheraaspace\",\"youtube\":\"https:\\/\\/www.youtube.com\\/@pantheraaspace\"}','2026-06-18 00:13:23','2026-06-18 00:13:23'),(14,'learnings_tagline','\"Daily notes on AI, LLMs, RAG & building on the frontier.\"','2026-06-18 00:13:23','2026-06-18 00:13:23'),(15,'learnings_categories','[\"AI News\",\"LLMs\",\"RAG\",\"Prompting\",\"Agents\",\"Machine Learning\",\"Code\",\"Math\",\"Essay\",\"Tools\"]','2026-06-18 00:13:23','2026-06-18 00:13:23');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `stats` WRITE;
/*!40000 ALTER TABLE `stats` DISABLE KEYS */;
INSERT INTO `stats` VALUES (1,'320','+','Campaigns launched',0,1,'2026-06-18 00:13:23','2026-06-18 00:13:23'),(2,'4.8','x','Average client ROAS',1,1,'2026-06-18 00:13:23','2026-06-18 00:13:23'),(3,'98','%','Client retention',2,1,'2026-06-18 00:13:23','2026-06-18 00:13:23'),(4,'65','+','Brands scaled',3,1,'2026-06-18 00:13:23','2026-06-18 00:13:23');
/*!40000 ALTER TABLE `stats` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscribers_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `quote` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'Pantheraa Space took us from invisible to page one in two quarters. Organic now drives 60% of our demos.','Aarav Mehta','Founder, FinFlow SaaS',0,1,'2026-06-18 00:13:23','2026-06-18 00:13:23'),(2,'They are the first agency that actually understood AI search. We now show up inside ChatGPT answers for our category.','Sara Khan','CMO, Lumen Skincare',1,1,'2026-06-18 00:13:23','2026-06-18 00:13:23'),(3,'ROAS jumped from 1.9x to 5.3x in 90 days. Reporting is brutally honest and the team feels in-house.','Daniel Roberts','Growth Lead, Vault Commerce',2,1,'2026-06-18 00:13:23','2026-06-18 00:13:23');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Pantheraa Admin','admin@pantheraa.space',NULL,'$2y$12$LauxZEphUz2r2nMGKD1Z6u6RZh1PeyDb.B9H1uuN7CHePd5HPQaHq',NULL,'2026-06-18 00:13:25','2026-06-18 00:13:25');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

