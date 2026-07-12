@php
    $capabilities = [
        ['icon' => 'bot',      'title' => 'AI Chatbots & Assistants', 'desc' => 'Web, WhatsApp & support bots that answer instantly and capture leads 24/7.'],
        ['icon' => 'workflow', 'title' => 'Autonomous AI Agents',     'desc' => 'Multi-step agents that research, decide and complete tasks on their own.'],
        ['icon' => 'wand',     'title' => 'Custom AI Tools & Copilots','desc' => 'RAG copilots trained on your data, content engines and internal tools.'],
        ['icon' => 'plug',     'title' => 'Workflow Automation',       'desc' => 'Connect your CRM, email and ops so the busywork runs itself.'],
        ['icon' => 'mic',      'title' => 'AI Voice Agents',           'desc' => 'Human-like voice bots that qualify, book and follow up over calls.'],
        ['icon' => 'spark',    'title' => 'Generative Content',        'desc' => 'On-brand copy, creatives and campaigns produced at scale.'],
    ];
@endphp

<section id="ai" class="section relative overflow-hidden border-y border-ink-200 bg-ink-50">
    <div class="orb -left-20 top-10 h-80 w-80 bg-volt-600/20" data-parallax="0.06"></div>
    <div class="orb -right-24 bottom-0 h-80 w-80 bg-flame-600/20" data-parallax="0.1"></div>

    <div class="container-px relative">
        <div class="grid items-center gap-14 lg:grid-cols-12 lg:gap-16">
            {{-- Copy + capabilities --}}
            <div class="lg:col-span-7">
                <span class="kicker" data-reveal>
                    <span class="inline-block h-1.5 w-1.5 rounded-full bg-volt-500"></span>
                    AI Solutions
                </span>
                <h2 class="mt-5 text-3xl sm:text-4xl lg:text-5xl" data-reveal>
                    AI that does the work — <span class="text-gradient">not just the talk.</span>
                </h2>
                <p class="mt-4 max-w-xl text-ink-500" data-reveal>
                    Beyond marketing, we <span class="font-semibold text-ink-900">build AI products</span>:
                    chatbots, autonomous agents and custom tools trained on your data — deployed on your
                    site, WhatsApp or internal stack to automate sales, support and operations.
                </p>

                <div class="mt-9 grid gap-4 sm:grid-cols-2" data-stagger>
                    @foreach($capabilities as $cap)
                        <div class="flex items-start gap-3">
                            <span class="grid h-10 w-10 shrink-0 place-items-center rounded-lg border border-ink-200 bg-gradient-to-br from-flame-500/20 to-volt-500/20 text-ink-900">
                                <x-icon :name="$cap['icon']" class="h-5 w-5" />
                            </span>
                            <div>
                                <h3 class="text-base font-semibold text-ink-900">{{ $cap['title'] }}</h3>
                                <p class="mt-0.5 text-sm leading-snug text-ink-500">{{ $cap['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <a href="/contact" wire:navigate class="btn-primary mt-10" data-magnetic data-reveal>
                    Build my AI solution
                    <x-icon name="arrow" class="h-4 w-4" />
                </a>
            </div>

            {{-- Chatbot window mock --}}
            <div class="lg:col-span-5" data-reveal data-delay="0.1">
                <div class="relative mx-auto max-w-sm">
                    <div class="absolute inset-0 -z-10 rounded-3xl bg-gradient-to-br from-flame-600/25 to-volt-600/25 blur-2xl"></div>

                    <div class="overflow-hidden rounded-3xl border border-ink-200 bg-white/85 shadow-2xl backdrop-blur">
                        {{-- Header --}}
                        <div class="flex items-center gap-3 border-b border-ink-200 bg-ink-50 px-5 py-4">
                            <span class="relative grid h-9 w-9 place-items-center rounded-lg bg-ink-100">
                                <x-panther class="h-6 w-6 text-ink-900" />
                            </span>
                            <div>
                                <div class="text-sm font-semibold text-ink-900">Pantheraa AI</div>
                                <div class="flex items-center gap-1.5 text-xs text-ink-500">
                                    <span class="inline-block h-1.5 w-1.5 rounded-full bg-green-400"></span> Online now
                                </div>
                            </div>
                        </div>

                        {{-- Messages --}}
                        <div class="space-y-3 p-5">
                            <div class="max-w-[85%] rounded-2xl rounded-tl-sm border border-ink-200 bg-ink-50 px-4 py-2.5 text-sm text-ink-700">
                                Hi! 👋 I'm your AI assistant. How can I help grow your business today?
                            </div>
                            <div class="ml-auto max-w-[85%] rounded-2xl rounded-tr-sm bg-gradient-to-r from-flame-500 to-volt-500 px-4 py-2.5 text-sm text-white">
                                Can you qualify and book leads 24/7?
                            </div>
                            <div class="max-w-[85%] rounded-2xl rounded-tl-sm border border-ink-200 bg-ink-50 px-4 py-2.5 text-sm text-ink-700">
                                Absolutely. I capture, qualify and book meetings automatically — even at 3 AM. 🚀
                            </div>
                            {{-- typing indicator --}}
                            <div class="flex w-fit items-center gap-1.5 rounded-2xl rounded-tl-sm border border-ink-200 bg-ink-50 px-4 py-3">
                                <span class="h-1.5 w-1.5 animate-bounce rounded-full bg-ink-400" style="animation-delay:0ms"></span>
                                <span class="h-1.5 w-1.5 animate-bounce rounded-full bg-ink-400" style="animation-delay:150ms"></span>
                                <span class="h-1.5 w-1.5 animate-bounce rounded-full bg-ink-400" style="animation-delay:300ms"></span>
                            </div>
                        </div>

                        {{-- Input bar --}}
                        <div class="flex items-center gap-2 border-t border-ink-200 px-4 py-3">
                            <div class="flex-1 rounded-full border border-ink-200 bg-ink-50 px-4 py-2 text-sm text-ink-400">Ask anything…</div>
                            <span class="grid h-9 w-9 place-items-center rounded-full bg-gradient-to-r from-flame-500 to-volt-500 text-white">
                                <x-icon name="arrow" class="h-4 w-4" />
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
