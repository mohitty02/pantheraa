import './bootstrap';
import { animate, inView, stagger, scroll } from 'motion';

/*
|--------------------------------------------------------------------------
| Pantheraa Space — Motion engine (Motion One / motion.dev)
|--------------------------------------------------------------------------
| Motion One is the vanilla-JS animation library from the creator of
| Framer Motion. Same spring physics & scroll API, no React needed —
| perfect with Livewire + Alpine. We re-run on Livewire SPA navigation.
*/

const reduceMotion =
    window.matchMedia &&
    window.matchMedia('(prefers-reduced-motion: reduce)').matches;

const EASE = [0.22, 1, 0.36, 1];

/** Reveal a single element from below + fade in. */
function reveal(el, { delay = 0 } = {}) {
    if (reduceMotion) {
        el.style.opacity = 1;
        return;
    }
    animate(
        el,
        { opacity: [0, 1], transform: ['translateY(30px)', 'translateY(0px)'] },
        { duration: 0.75, delay, easing: EASE }
    );
}

/** Wire up scroll-triggered reveals + staggered groups. */
function initReveals() {
    // Simple one-shot reveals
    inView(
        '[data-reveal]:not([data-played])',
        (el) => {
            el.dataset.played = '1';
            reveal(el, { delay: parseFloat(el.dataset.delay || 0) });
        },
        { amount: 0.15, margin: '0px 0px -80px 0px' }
    );

    // Staggered children groups
    inView(
        '[data-stagger]:not([data-played])',
        (group) => {
            group.dataset.played = '1';
            const kids = Array.from(group.children);
            if (reduceMotion) {
                kids.forEach((k) => (k.style.opacity = 1));
                return;
            }
            const delayFor = stagger(0.09, { startDelay: 0.05 });
            kids.forEach((kid, i) => {
                animate(
                    kid,
                    { opacity: [0, 1], transform: ['translateY(26px)', 'translateY(0px)'] },
                    { duration: 0.7, delay: delayFor(i, kids.length), easing: EASE }
                );
            });
        },
        { amount: 0.12, margin: '0px 0px -60px 0px' }
    );
}

/** Animated number counters: <span data-counter="120">. */
function initCounters() {
    inView(
        '[data-counter]:not([data-counted])',
        (el) => {
            el.dataset.counted = '1';
            const target = parseFloat(el.dataset.counter);
            const decimals = (el.dataset.counter.split('.')[1] || '').length;
            if (reduceMotion) {
                el.textContent = target.toFixed(decimals);
                return;
            }
            animate(0, target, {
                duration: 1.8,
                easing: EASE,
                onUpdate: (v) => {
                    el.textContent = v.toFixed(decimals);
                },
            });
        },
        { amount: 0.6 }
    );
}

/** Hero intro: play immediately on load. */
function initHero() {
    const items = document.querySelectorAll('[data-hero]:not([data-played])');
    items.forEach((el, i) => {
        el.dataset.played = '1';
        reveal(el, { delay: 0.08 * i });
    });
}

/** Magnetic buttons follow the cursor slightly. */
function initMagnetic() {
    if (reduceMotion || window.matchMedia('(pointer: coarse)').matches) return;
    document.querySelectorAll('[data-magnetic]:not([data-bound])').forEach((el) => {
        el.dataset.bound = '1';
        const strength = 0.35;
        el.addEventListener('pointermove', (e) => {
            const r = el.getBoundingClientRect();
            const x = (e.clientX - (r.left + r.width / 2)) * strength;
            const y = (e.clientY - (r.top + r.height / 2)) * strength;
            animate(el, { transform: `translate(${x}px, ${y}px)` }, { duration: 0.3, easing: EASE });
        });
        el.addEventListener('pointerleave', () => {
            animate(el, { transform: 'translate(0px, 0px)' }, { duration: 0.5, easing: EASE });
        });
    });
}

/** Top scroll-progress bar. */
function initScrollProgress() {
    const bar = document.getElementById('scroll-progress');
    if (!bar || bar.dataset.bound) return;
    bar.dataset.bound = '1';
    scroll((progress) => {
        bar.style.transform = `scaleX(${progress})`;
    });
}

/** Subtle parallax drift on decorative orbs. */
function initParallax() {
    if (reduceMotion) return;
    document.querySelectorAll('[data-parallax]:not([data-bound])').forEach((el) => {
        el.dataset.bound = '1';
        const speed = parseFloat(el.dataset.parallax || 0.2);
        scroll(
            (_p, info) => {
                el.style.transform = `translateY(${info.y.current * speed}px)`;
            }
        );
    });
}

/* ---- Rich content: syntax highlighting (highlight.js) + LaTeX (KaTeX) ----
   Loaded on-demand: these libs are only fetched on pages that actually
   render Markdown content (Learnings + admin editor), so marketing pages
   stay lightweight. */
const KATEX_OPTS = {
    delimiters: [
        { left: '$$', right: '$$', display: true },
        { left: '\\[', right: '\\]', display: true },
        { left: '\\(', right: '\\)', display: false },
        { left: '$', right: '$', display: false },
    ],
    throwOnError: false,
    ignoredTags: ['script', 'noscript', 'style', 'textarea', 'pre', 'code'],
};

let richLibs = null;
async function loadRichLibs() {
    if (!richLibs) {
        const [hljsMod, katexMod] = await Promise.all([
            import('highlight.js/lib/common'),
            import('katex/contrib/auto-render'),
            import('highlight.js/styles/github-dark.css'),
            import('katex/dist/katex.min.css'),
        ]);
        hljsMod.default.configure({ ignoreUnescapedHTML: true });
        richLibs = { hljs: hljsMod.default, renderMath: katexMod.default };
    }

    return richLibs;
}

async function initRich() {
    const roots = document.querySelectorAll('[data-rich]');
    if (! roots.length) return;

    const { hljs, renderMath } = await loadRichLibs();
    roots.forEach((root) => {
        root.querySelectorAll('pre code').forEach((block) => {
            block.removeAttribute('data-highlighted');
            block.className = block.className.replace(/\bhljs\b/g, '').trim();
            hljs.highlightElement(block);
        });
        try {
            renderMath(root, KATEX_OPTS);
        } catch (e) {
            /* ignore malformed math */
        }
    });
}

function boot() {
    document.documentElement.classList.remove('no-js');
    initHero();
    initReveals();
    initCounters();
    initMagnetic();
    initScrollProgress();
    initParallax();
    initRich();
}

document.addEventListener('DOMContentLoaded', boot);
// Re-run after Livewire SPA navigation swaps the DOM.
document.addEventListener('livewire:navigated', boot);

// Re-render code/math after any Livewire update (e.g. the editor live preview).
document.addEventListener('livewire:init', () => {
    window.Livewire?.hook('commit', ({ succeed }) => {
        succeed(() => queueMicrotask(initRich));
    });
});
