@if ($datatable->language->language == null)
    @if ($datatable->language->cdnLanguageByLocale)
        "language": {
            "url": "{{ $datatable->language->languageCDNFile[$locale] }}"
        }
    @endif

    @if ($datatable->language->languageByLocale)
        "language": @include('datatable.i18n.' . $locale)
    @endif
@else
    "language": @include('datatable.i18n.' . $locale)
@endif
