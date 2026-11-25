@php
    $analyticsEnabled = config('analytics.enabled') && filled(config('analytics.ga4_measurement_id'));
    $ga4Id = config('analytics.ga4_measurement_id');
    $adsId = config('analytics.google_ads_id');
@endphp

@if($analyticsEnabled)
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $ga4Id }}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', @json($ga4Id), {
        anonymize_ip: true,
        send_page_view: true
    });
    @if(filled($adsId))
    gtag('config', @json($adsId));
    @endif
</script>
@endif

<script>
window.InskolaAnalytics = (function () {
    var fired = Object.create(null);

    function canSend() {
        return typeof window.gtag === 'function';
    }

    function track(eventName, params, onceKey) {
        if (!eventName) return;
        if (onceKey) {
            if (fired[onceKey]) return;
            fired[onceKey] = true;
        }

        var payload = params || {};
        // Never send personal data (names, phones, messages)
        delete payload.name;
        delete payload.phone;
        delete payload.email;
        delete payload.message;
        delete payload.user_data;

        if (!canSend()) {
            if (window.INSKOLA_ANALYTICS_DEBUG) {
                console.debug('[analytics:queued]', eventName, payload);
            }
            return;
        }

        gtag('event', eventName, payload);
    }

    function bindClicks() {
        document.addEventListener('click', function (event) {
            var target = event.target.closest('[data-analytics-event]');
            if (!target) return;

            var eventName = target.getAttribute('data-analytics-event');
            var onceKey = target.getAttribute('data-analytics-once') || null;
            var params = {};

            try {
                var raw = target.getAttribute('data-analytics-params');
                if (raw) params = JSON.parse(raw);
            } catch (e) {}

            if (!params.location) {
                params.location = target.getAttribute('data-analytics-location') || 'unknown';
            }

            track(eventName, params, onceKey ? (eventName + ':' + onceKey) : null);
        }, { passive: true });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', bindClicks);
    } else {
        bindClicks();
    }

    return {
        track: track,
        clickWhatsapp: function (location) {
            track('click_whatsapp', { location: location || 'unknown' });
        },
        clickBooking: function (location) {
            track('click_booking', { location: location || 'unknown' });
        },
        bookingSubmit: function (location) {
            track('booking_submit', { location: location || 'contact_form' }, 'booking_submit:' + (location || 'contact_form'));
        },
        signUp: function (method) {
            track('sign_up', { method: method || 'website' }, 'sign_up');
        },
        purchase: function (payload) {
            // Call only after confirmed successful payment (no PII).
            track('purchase', payload || {}, payload && payload.transaction_id
                ? ('purchase:' + payload.transaction_id)
                : null);
        }
    };
})();
</script>
