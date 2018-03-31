@if ($datatable->language->getLanguage() == null)
    @if ($datatable->language->isCdnLanguageByLocale())
        "language": {
        "url": "/datatables/language"
        }
    @endif

    @if ($datatable->language->isLanguageByLocale())
        "language": @include('datatable.i18n.' . $locale)
    @endif
@else
    "language": @include('datatable.i18n.' . $locale)
@endif
