.. php:class:: TYPO3\CMS\Seo\Event\ModifyUrlForCanonicalTagEvent

    PSR-14 to alter (or empty) a canonical URL for the href="" attribute of a canonical URL.

    .. php:method:: getUrl()

        Get the URL.

        :returntype: string

    .. php:method:: setUrl(string url)

        :param string $url: the url