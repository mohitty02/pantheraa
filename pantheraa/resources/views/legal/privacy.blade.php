@php $s = config('site'); @endphp

<x-app-layout
    title="Privacy Policy"
    description="How Pantheraa Space collects, uses and protects your personal information."
>
    <section class="pb-20 pt-36 sm:pt-44">
        <div class="container-px">
            <div class="mx-auto max-w-3xl">
                <span class="kicker" data-hero>Legal</span>
                <h1 class="mt-5 text-4xl font-bold sm:text-5xl" data-hero>Privacy Policy</h1>
                <p class="mt-4 text-ink-500" data-hero>Last updated: {{ now()->format('d F Y') }}</p>

                <div class="prose-rich mt-10">
                    <p>{{ $s['legal_name'] }} ("we", "us", "our") respects your privacy. This policy explains what
                    information we collect when you use <strong>{{ rtrim($s['url'], '/') }}</strong>, why we collect it,
                    and what we do with it.</p>

                    <h2>Information we collect</h2>
                    <ul>
                        <li><strong>Information you give us.</strong> When you submit the contact form or subscribe to our
                        newsletter, we collect your name, email address, phone number, company name and the message you send.</li>
                        <li><strong>Usage information.</strong> Like most websites, we collect standard analytics data —
                        pages viewed, approximate location, device and browser type, and how you found us.</li>
                    </ul>

                    <h2>How we use it</h2>
                    <ul>
                        <li>To reply to your enquiry and provide the services you asked about.</li>
                        <li>To send you the newsletter, if you subscribed. You can unsubscribe at any time.</li>
                        <li>To understand how our website is used, so we can improve it.</li>
                    </ul>

                    <h2>What we do not do</h2>
                    <p>We do <strong>not</strong> sell, rent or trade your personal information to anyone. We do not send
                    unsolicited marketing to people who have not asked for it.</p>

                    <h2>Cookies &amp; analytics</h2>
                    <p>We use cookies and third-party analytics tools (such as Google Analytics) to understand website usage.
                    These may set cookies on your device. You can block or delete cookies through your browser settings —
                    the website will still work.</p>
                    <p>If we run advertising, our advertising partners (such as Google and Meta) may also use cookies to
                    measure the performance of ads.</p>

                    <h2>Data retention</h2>
                    <p>We keep enquiry data for as long as needed to serve you, and to keep proper business records.
                    You can ask us to delete your data at any time.</p>

                    <h2>Your rights</h2>
                    <p>You can ask us to:</p>
                    <ul>
                        <li>Tell you what personal data we hold about you</li>
                        <li>Correct anything that is wrong</li>
                        <li>Delete your data</li>
                        <li>Stop sending you marketing emails</li>
                    </ul>
                    <p>To make any of these requests, email us at
                    <a href="mailto:{{ $s['email'] }}">{{ $s['email'] }}</a> and we will action it.</p>

                    <h2>Security</h2>
                    <p>The site runs over HTTPS and we take reasonable technical measures to protect your data.
                    No system is perfectly secure, but we treat your information with care.</p>

                    <h2>Third parties</h2>
                    <p>We use trusted third-party services to run our business (for example hosting, email and analytics
                    providers). They only receive the data they need to provide their service.</p>

                    <h2>Changes to this policy</h2>
                    <p>If we change this policy, we will update the date at the top of this page.</p>

                    <h2>Contact us</h2>
                    <p>Questions about privacy? Email <a href="mailto:{{ $s['email'] }}">{{ $s['email'] }}</a>
                    or call <a href="tel:{{ $s['phone_link'] }}">{{ $s['phone'] }}</a>.</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
