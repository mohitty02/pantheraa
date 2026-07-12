@php $s = config('site'); @endphp

<x-app-layout
    title="Terms of Service"
    description="The terms under which Pantheraa Space provides its services."
>
    <section class="pb-20 pt-36 sm:pt-44">
        <div class="container-px">
            <div class="mx-auto max-w-3xl">
                <span class="kicker" data-hero>Legal</span>
                <h1 class="mt-5 text-4xl font-bold sm:text-5xl" data-hero>Terms of Service</h1>
                <p class="mt-4 text-ink-500" data-hero>Last updated: {{ now()->format('d F Y') }}</p>

                <div class="prose-rich mt-10">
                    <p>These terms apply when you engage {{ $s['legal_name'] }} ("we", "us") for any service, and when
                    you use <strong>{{ rtrim($s['url'], '/') }}</strong>.</p>

                    <h2>Our services</h2>
                    <p>We provide website development, software and app development, Google Ads and Meta Ads management,
                    SEO, Google Business Profile optimization and AI search optimization. The exact scope of any engagement
                    is set out in a written proposal agreed by both sides before work starts.</p>

                    <h2>Quotes and payment</h2>
                    <ul>
                        <li>Quotes are valid for 30 days unless stated otherwise.</li>
                        <li>Project work typically requires an advance to begin, with the balance on agreed milestones.</li>
                        <li>Retainers (ads, SEO, GMB) are billed monthly in advance.</li>
                        <li><strong>Ad spend is separate from our fees</strong> and is paid by you directly to the platform.</li>
                    </ul>

                    <h2>What we promise</h2>
                    <p>We will do the work described in your proposal to a professional standard, communicate honestly,
                    and report transparently on what we did and what it returned.</p>

                    <h2>What we cannot promise</h2>
                    <p>We do <strong>not</strong> guarantee specific rankings, traffic volumes, lead counts or revenue.
                    Search engines and ad platforms are controlled by third parties (Google, Meta and others) and their
                    algorithms and policies change without notice. Any agency that guarantees a #1 ranking is not being
                    honest with you.</p>
                    <p>What we do guarantee is a proven process, real effort and full transparency.</p>

                    <h2>Your responsibilities</h2>
                    <ul>
                        <li>Provide content, assets, access and feedback in reasonable time — most project delays are caused by waiting on these.</li>
                        <li>Ensure you have the rights to any content, images or trademarks you give us.</li>
                        <li>Keep your own account credentials secure.</li>
                    </ul>

                    <h2>Ownership</h2>
                    <p>On full payment, you own the final deliverables — your website, code, designs, ad accounts and content.
                    We retain the right to reference the work in our portfolio unless you ask us not to.</p>

                    <h2>Cancellation</h2>
                    <p>Retainers can be cancelled with 30 days' written notice. We do not lock clients into long contracts —
                    we would rather you stay because the work is working. Fees for work already completed are non-refundable.</p>

                    <h2>Confidentiality</h2>
                    <p>We keep your business information confidential and will sign an NDA on request.</p>

                    <h2>Liability</h2>
                    <p>Our total liability for any claim is limited to the fees you paid us for the service in question.
                    We are not liable for indirect or consequential losses.</p>

                    <h2>Governing law</h2>
                    <p>These terms are governed by the laws of India, and disputes are subject to the jurisdiction of the
                    courts in {{ $s['address']['locality'] ?? 'India' }}.</p>

                    <h2>Contact</h2>
                    <p>Questions? Email <a href="mailto:{{ $s['email'] }}">{{ $s['email'] }}</a>
                    or call <a href="tel:{{ $s['phone_link'] }}">{{ $s['phone'] }}</a>.</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
