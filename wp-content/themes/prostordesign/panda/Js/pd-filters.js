(() => {
    const form = document.getElementById('pdFilterForm');
    const resultsEl = document.getElementById('pdResults');
    const categoryId = document.getElementById('pdFilterCategory');

    if (!form || !resultsEl || typeof pdFilters === 'undefined') return;

    // Loader with counter (safe with abort/multiple requests)
    const pdLoading = (() => {
        const el = document.getElementById('pdLoader');
        let count = 0;

        const show = () => {
            if (!el) return;
            count++;
            el.setAttribute('aria-hidden', 'false');
            document.documentElement.classList.add('pd-loading');
            document.body.classList.add('pd-loading');
        };

        const hide = () => {
            if (!el) return;
            count = Math.max(0, count - 1);
            if (count === 0) {
                el.setAttribute('aria-hidden', 'true');
                document.documentElement.classList.remove('pd-loading');
                document.body.classList.remove('pd-loading');
            }
        };

        return { show, hide };
    })();

    let debounceT = null;
    let controller = null;

    const serializeFilters = () => {
        const filters = {};
        form.querySelectorAll('select[name]').forEach(sel => {
            const v = sel.value;
            if (v !== '' && v != null) filters[sel.name] = v;
        });
        return filters;
    };

    const update = async () => {
        // Abort previous request
        if (controller) controller.abort();
        controller = new AbortController();

        const payload = new FormData();
        payload.append('action', 'pd_filter_products');
        payload.append('nonce', pdFilters.nonce);
        payload.append('filters', JSON.stringify(serializeFilters()));
        payload.append('category_id', categoryId.value);

        // optional: per-page / ordering
        payload.append('per_page', String(pdFilters.perPage || 12));

        pdLoading.show();

        try {
            const res = await fetch(pdFilters.ajaxUrl, {
                method: 'POST',
                body: payload,
                signal: controller.signal,
                credentials: 'same-origin'
            });

            const json = await res.json();
            if (!json || !json.success) throw new Error('AJAX failed');

            resultsEl.innerHTML = json.data.html || '';
            pdRehydrateLazyImages(resultsEl);
        } catch (err) {
            if (err.name !== 'AbortError') {
                console.error(err);
            }
        } finally {
            pdLoading.hide();
        }
    };

    // Change -> debounce
    form.addEventListener('change', (e) => {
        if (!e.target.matches('select')) return;
        clearTimeout(debounceT);
        debounceT = setTimeout(update, 180);
    });

})();

function pdRehydrateLazyImages(scopeEl) {
    if (!scopeEl) return;

    const imgs = scopeEl.querySelectorAll('img[data-src], img[data-srcset], source[data-srcset]');
    imgs.forEach(el => {
        if (el.tagName === 'IMG') {
            const ds = el.getAttribute('data-src');
            const dss = el.getAttribute('data-srcset');

            if (ds && !el.getAttribute('src')) el.setAttribute('src', ds);
            if (ds) el.setAttribute('src', ds);
            if (dss) el.setAttribute('srcset', dss);

            el.removeAttribute('data-src');
            el.removeAttribute('data-srcset');

            // časté třídy pluginů
            el.classList.remove('lazyload', 'lazy', 'litespeed-loaded');
            el.classList.add('pd-lazy-fixed');
        } else if (el.tagName === 'SOURCE') {
            const dss = el.getAttribute('data-srcset');
            if (dss) el.setAttribute('srcset', dss);
            el.removeAttribute('data-srcset');
        }
    });
}