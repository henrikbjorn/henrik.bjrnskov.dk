<?php

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InactiveScopeException;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/**
 * appDevDebugProjectContainer
 *
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 */
class appDevDebugProjectContainer extends Container
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->parameters = $this->getDefaultParameters();

        $this->services =
        $this->scopedServices =
        $this->scopeStacks = array();

        $this->set('service_container', $this);

        $this->scopes = array('request' => 'container');
        $this->scopeChildren = array('request' => array());
    }

    /**
     * Gets the 'annotation_reader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Doctrine\Common\Annotations\FileCacheReader A Doctrine\Common\Annotations\FileCacheReader instance.
     */
    protected function getAnnotationReaderService()
    {
        return $this->services['annotation_reader'] = new \Doctrine\Common\Annotations\FileCacheReader(new \Doctrine\Common\Annotations\AnnotationReader(), '/Users/Henrik/Code/Play/sculpin-blog/app/cache/dev/annotations', true);
    }

    /**
     * Gets the 'cache_clearer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\CacheClearer\ChainCacheClearer A Symfony\Component\HttpKernel\CacheClearer\ChainCacheClearer instance.
     */
    protected function getCacheClearerService()
    {
        return $this->services['cache_clearer'] = new \Symfony\Component\HttpKernel\CacheClearer\ChainCacheClearer(array());
    }

    /**
     * Gets the 'cache_warmer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerAggregate A Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerAggregate instance.
     */
    protected function getCacheWarmerService()
    {
        return $this->services['cache_warmer'] = new \Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerAggregate(array());
    }

    /**
     * Gets the 'debug.controller_resolver' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\Controller\TraceableControllerResolver A Symfony\Component\HttpKernel\Controller\TraceableControllerResolver instance.
     */
    protected function getDebug_ControllerResolverService()
    {
        return $this->services['debug.controller_resolver'] = new \Symfony\Component\HttpKernel\Controller\TraceableControllerResolver(new \Symfony\Bundle\FrameworkBundle\Controller\ControllerResolver($this, new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser($this->get('kernel')), NULL), $this->get('debug.stopwatch'));
    }

    /**
     * Gets the 'debug.deprecation_logger_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\EventListener\DeprecationLoggerListener A Symfony\Component\HttpKernel\EventListener\DeprecationLoggerListener instance.
     */
    protected function getDebug_DeprecationLoggerListenerService()
    {
        return $this->services['debug.deprecation_logger_listener'] = new \Symfony\Component\HttpKernel\EventListener\DeprecationLoggerListener(NULL);
    }

    /**
     * Gets the 'debug.event_dispatcher' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher A Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher instance.
     */
    protected function getDebug_EventDispatcherService()
    {
        $this->services['debug.event_dispatcher'] = $instance = new \Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher($this->get('event_dispatcher'), $this->get('debug.stopwatch'), NULL);

        $instance->setProfiler(NULL);

        return $instance;
    }

    /**
     * Gets the 'debug.stopwatch' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Stopwatch\Stopwatch A Symfony\Component\Stopwatch\Stopwatch instance.
     */
    protected function getDebug_StopwatchService()
    {
        return $this->services['debug.stopwatch'] = new \Symfony\Component\Stopwatch\Stopwatch();
    }

    /**
     * Gets the 'event_dispatcher' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher A Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher instance.
     */
    protected function getEventDispatcherService()
    {
        $this->services['event_dispatcher'] = $instance = new \Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher($this);

        $instance->addSubscriberService('sculpin_markdown.converter', 'Sculpin\\Bundle\\MarkdownBundle\\MarkdownConverter');
        $instance->addSubscriberService('sculpin_textile.converter', 'Sculpin\\Bundle\\TextileBundle\\TextileConverter');
        $instance->addSubscriberService('sculpin_markdown_twig_compat.converter_listener', 'Sculpin\\Bundle\\MarkdownTwigCompatBundle\\ConvertListener');
        $instance->addSubscriberService('sculpin_posts.posts_data_provider', 'Sculpin\\Bundle\\PostsBundle\\PostsDataProvider');
        $instance->addSubscriberService('sculpin_posts.posts_tags_data_provider', 'Sculpin\\Bundle\\PostsBundle\\PostsTagsDataProvider');
        $instance->addSubscriberService('sculpin_posts.posts_categories_data_provider', 'Sculpin\\Bundle\\PostsBundle\\PostsCategoriesDataProvider');
        $instance->addSubscriberService('sculpin_twig.template_resetter', 'Sculpin\\Bundle\\TwigBundle\\TemplateResetter');
        $instance->addSubscriberService('response_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\ResponseListener');
        $instance->addSubscriberService('streamed_response_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\StreamedResponseListener');
        $instance->addSubscriberService('locale_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\LocaleListener');
        $instance->addSubscriberService('http_content_renderer', 'Symfony\\Component\\HttpKernel\\HttpContentRenderer');
        $instance->addSubscriberService('debug.deprecation_logger_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\DeprecationLoggerListener');

        return $instance;
    }

    /**
     * Gets the 'file_locator' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\Config\FileLocator A Symfony\Component\HttpKernel\Config\FileLocator instance.
     */
    protected function getFileLocatorService()
    {
        return $this->services['file_locator'] = new \Symfony\Component\HttpKernel\Config\FileLocator($this->get('kernel'), '/Users/Henrik/Code/Play/sculpin-blog/app/Resources');
    }

    /**
     * Gets the 'filesystem' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Filesystem\Filesystem A Symfony\Component\Filesystem\Filesystem instance.
     */
    protected function getFilesystemService()
    {
        return $this->services['filesystem'] = new \Symfony\Component\Filesystem\Filesystem();
    }

    /**
     * Gets the 'http_content_renderer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\HttpContentRenderer A Symfony\Component\HttpKernel\HttpContentRenderer instance.
     */
    protected function getHttpContentRendererService()
    {
        $this->services['http_content_renderer'] = $instance = new \Symfony\Component\HttpKernel\HttpContentRenderer(array(), true);

        $instance->addStrategy($this->get('http_content_renderer.strategy.default'));
        $instance->addStrategy($this->get('http_content_renderer.strategy.hinclude'));

        return $instance;
    }

    /**
     * Gets the 'http_content_renderer.strategy.default' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\RenderingStrategy\DefaultRenderingStrategy A Symfony\Component\HttpKernel\RenderingStrategy\DefaultRenderingStrategy instance.
     */
    protected function getHttpContentRenderer_Strategy_DefaultService()
    {
        $this->services['http_content_renderer.strategy.default'] = $instance = new \Symfony\Component\HttpKernel\RenderingStrategy\DefaultRenderingStrategy($this->get('http_kernel'));

        $instance->setProxyPath('/_proxy');

        return $instance;
    }

    /**
     * Gets the 'http_content_renderer.strategy.hinclude' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\RenderingStrategy\ContainerAwareHIncludeRenderingStrategy A Symfony\Bundle\FrameworkBundle\RenderingStrategy\ContainerAwareHIncludeRenderingStrategy instance.
     */
    protected function getHttpContentRenderer_Strategy_HincludeService()
    {
        $this->services['http_content_renderer.strategy.hinclude'] = $instance = new \Symfony\Bundle\FrameworkBundle\RenderingStrategy\ContainerAwareHIncludeRenderingStrategy($this, $this->get('uri_signer'), '');

        $instance->setProxyPath('/_proxy');

        return $instance;
    }

    /**
     * Gets the 'http_kernel' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\HttpKernel A Symfony\Bundle\FrameworkBundle\HttpKernel instance.
     */
    protected function getHttpKernelService()
    {
        return $this->services['http_kernel'] = new \Symfony\Bundle\FrameworkBundle\HttpKernel($this->get('debug.event_dispatcher'), $this, $this->get('debug.controller_resolver'));
    }

    /**
     * Gets the 'kernel' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @throws RuntimeException always since this service is expected to be injected dynamically
     */
    protected function getKernelService()
    {
        throw new RuntimeException('You have requested a synthetic service ("kernel"). The DIC does not know how to construct this service.');
    }

    /**
     * Gets the 'locale_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\EventListener\LocaleListener A Symfony\Component\HttpKernel\EventListener\LocaleListener instance.
     */
    protected function getLocaleListenerService()
    {
        return $this->services['locale_listener'] = new \Symfony\Component\HttpKernel\EventListener\LocaleListener('en', NULL);
    }

    /**
     * Gets the 'request' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @throws RuntimeException always since this service is expected to be injected dynamically
     */
    protected function getRequestService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('request', 'request');
        }

        throw new RuntimeException('You have requested a synthetic service ("request"). The DIC does not know how to construct this service.');
    }

    /**
     * Gets the 'response_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\EventListener\ResponseListener A Symfony\Component\HttpKernel\EventListener\ResponseListener instance.
     */
    protected function getResponseListenerService()
    {
        return $this->services['response_listener'] = new \Symfony\Component\HttpKernel\EventListener\ResponseListener('UTF-8');
    }

    /**
     * Gets the 'sculpin' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Core\Sculpin A Sculpin\Core\Sculpin instance.
     */
    protected function getSculpinService()
    {
        return $this->services['sculpin'] = new \Sculpin\Core\Sculpin($this->get('sculpin.site_configuration'), $this->get('event_dispatcher'), $this->get('sculpin.source_permalink_factory'), $this->get('sculpin.writer'), $this->get('sculpin.generator_manager'), $this->get('sculpin.formatter_manager'), $this->get('sculpin.converter_manager'));
    }

    /**
     * Gets the 'sculpin.converter_manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Core\Converter\ConverterManager A Sculpin\Core\Converter\ConverterManager instance.
     */
    protected function getSculpin_ConverterManagerService()
    {
        $this->services['sculpin.converter_manager'] = $instance = new \Sculpin\Core\Converter\ConverterManager($this->get('event_dispatcher'), $this->get('sculpin.formatter_manager'));

        $instance->registerConverter('markdown', $this->get('sculpin_markdown.converter'));
        $instance->registerConverter('textile', $this->get('sculpin_textile.converter'));

        return $instance;
    }

    /**
     * Gets the 'sculpin.data_provider_manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Core\DataProvider\DataProviderManager A Sculpin\Core\DataProvider\DataProviderManager instance.
     */
    protected function getSculpin_DataProviderManagerService()
    {
        $this->services['sculpin.data_provider_manager'] = $instance = new \Sculpin\Core\DataProvider\DataProviderManager();

        $instance->registerDataProvider('posts', $this->get('sculpin_posts.posts_data_provider'));
        $instance->registerDataProvider('posts_tags', $this->get('sculpin_posts.posts_tags_data_provider'));
        $instance->registerDataProvider('posts_categories', $this->get('sculpin_posts.posts_categories_data_provider'));

        return $instance;
    }

    /**
     * Gets the 'sculpin.data_source' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Core\Source\CompositeDataSource A Sculpin\Core\Source\CompositeDataSource instance.
     */
    protected function getSculpin_DataSourceService()
    {
        return $this->services['sculpin.data_source'] = new \Sculpin\Core\Source\CompositeDataSource(array(0 => $this->get('sculpin.default_filesystem_data_source')));
    }

    /**
     * Gets the 'sculpin.default_filesystem_data_source' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Core\Source\FilesystemDataSource A Sculpin\Core\Source\FilesystemDataSource instance.
     */
    protected function getSculpin_DefaultFilesystemDataSourceService()
    {
        return $this->services['sculpin.default_filesystem_data_source'] = new \Sculpin\Core\Source\FilesystemDataSource('/Users/Henrik/Code/Play/sculpin-blog/source', array(0 => '_views/**'), array(), array(), $this->get('sculpin.finder_factory'), $this->get('sculpin.matcher'));
    }

    /**
     * Gets the 'sculpin.finder_factory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Dflydev\Symfony\FinderFactory\FinderFactory A Dflydev\Symfony\FinderFactory\FinderFactory instance.
     */
    protected function getSculpin_FinderFactoryService()
    {
        return $this->services['sculpin.finder_factory'] = new \Dflydev\Symfony\FinderFactory\FinderFactory();
    }

    /**
     * Gets the 'sculpin.formatter_manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Core\Formatter\FormatterManager A Sculpin\Core\Formatter\FormatterManager instance.
     */
    protected function getSculpin_FormatterManagerService()
    {
        $this->services['sculpin.formatter_manager'] = $instance = new \Sculpin\Core\Formatter\FormatterManager($this->get('event_dispatcher'), $this->get('sculpin.site_configuration'));

        $instance->setDataProviderManager($this->get('sculpin.data_provider_manager'));
        $instance->registerFormatter('twig', $this->get('sculpin_twig.formatter'));

        return $instance;
    }

    /**
     * Gets the 'sculpin.generator_manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Core\Generator\GeneratorManager A Sculpin\Core\Generator\GeneratorManager instance.
     */
    protected function getSculpin_GeneratorManagerService()
    {
        $this->services['sculpin.generator_manager'] = $instance = new \Sculpin\Core\Generator\GeneratorManager($this->get('event_dispatcher'), $this->get('sculpin.site_configuration'));

        $instance->setDataProviderManager($this->get('sculpin.data_provider_manager'));
        $instance->registerGenerator('pagination', $this->get('sculpin_pagination.generator'));
        $instance->registerGenerator('posts_tag_index', $this->get('sculpin_posts.posts_tag_index_generator'));
        $instance->registerGenerator('posts_category_index', $this->get('sculpin_posts.posts_category_index_generator'));

        return $instance;
    }

    /**
     * Gets the 'sculpin.matcher' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return dflydev\util\antPathMatcher\AntPathMatcher A dflydev\util\antPathMatcher\AntPathMatcher instance.
     */
    protected function getSculpin_MatcherService()
    {
        return $this->services['sculpin.matcher'] = new \dflydev\util\antPathMatcher\AntPathMatcher();
    }

    /**
     * Gets the 'sculpin.site_configuration' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Dflydev\DotAccessConfiguration\Configuration A Dflydev\DotAccessConfiguration\Configuration instance.
     */
    protected function getSculpin_SiteConfigurationService()
    {
        return $this->services['sculpin.site_configuration'] = $this->get('sculpin.site_configuration_factory')->create();
    }

    /**
     * Gets the 'sculpin.site_configuration_factory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Core\SiteConfiguration\SiteConfigurationFactory A Sculpin\Core\SiteConfiguration\SiteConfigurationFactory instance.
     */
    protected function getSculpin_SiteConfigurationFactoryService()
    {
        return $this->services['sculpin.site_configuration_factory'] = new \Sculpin\Core\SiteConfiguration\SiteConfigurationFactory('/Users/Henrik/Code/Play/sculpin-blog/app', 'dev');
    }

    /**
     * Gets the 'sculpin.source_permalink_factory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Core\Permalink\SourcePermalinkFactory A Sculpin\Core\Permalink\SourcePermalinkFactory instance.
     */
    protected function getSculpin_SourcePermalinkFactoryService()
    {
        return $this->services['sculpin.source_permalink_factory'] = new \Sculpin\Core\Permalink\SourcePermalinkFactory('pretty');
    }

    /**
     * Gets the 'sculpin.writer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Core\Output\FilesystemWriter A Sculpin\Core\Output\FilesystemWriter instance.
     */
    protected function getSculpin_WriterService()
    {
        return $this->services['sculpin.writer'] = new \Sculpin\Core\Output\FilesystemWriter($this->get('filesystem'), '/Users/Henrik/Code/Play/sculpin-blog/output_dev');
    }

    /**
     * Gets the 'sculpin_markdown.converter' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Bundle\MarkdownBundle\MarkdownConverter A Sculpin\Bundle\MarkdownBundle\MarkdownConverter instance.
     */
    protected function getSculpinMarkdown_ConverterService()
    {
        return $this->services['sculpin_markdown.converter'] = new \Sculpin\Bundle\MarkdownBundle\MarkdownConverter($this->get('sculpin_markdown.parser'), array(0 => 'md', 1 => 'markdown'));
    }

    /**
     * Gets the 'sculpin_markdown.parser' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return dflydev\markdown\MarkdownParser A dflydev\markdown\MarkdownParser instance.
     */
    protected function getSculpinMarkdown_ParserService()
    {
        return $this->services['sculpin_markdown.parser'] = new \dflydev\markdown\MarkdownParser();
    }

    /**
     * Gets the 'sculpin_markdown_twig_compat.converter_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Bundle\MarkdownTwigCompatBundle\ConvertListener A Sculpin\Bundle\MarkdownTwigCompatBundle\ConvertListener instance.
     */
    protected function getSculpinMarkdownTwigCompat_ConverterListenerService()
    {
        return $this->services['sculpin_markdown_twig_compat.converter_listener'] = new \Sculpin\Bundle\MarkdownTwigCompatBundle\ConvertListener();
    }

    /**
     * Gets the 'sculpin_pagination.generator' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Bundle\PaginationBundle\PaginationGenerator A Sculpin\Bundle\PaginationBundle\PaginationGenerator instance.
     */
    protected function getSculpinPagination_GeneratorService()
    {
        return $this->services['sculpin_pagination.generator'] = new \Sculpin\Bundle\PaginationBundle\PaginationGenerator($this->get('sculpin.data_provider_manager'), '10');
    }

    /**
     * Gets the 'sculpin_posts.posts_categories_data_provider' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Bundle\PostsBundle\PostsCategoriesDataProvider A Sculpin\Bundle\PostsBundle\PostsCategoriesDataProvider instance.
     */
    protected function getSculpinPosts_PostsCategoriesDataProviderService()
    {
        return $this->services['sculpin_posts.posts_categories_data_provider'] = new \Sculpin\Bundle\PostsBundle\PostsCategoriesDataProvider($this->get('sculpin.data_provider_manager'));
    }

    /**
     * Gets the 'sculpin_posts.posts_category_index_generator' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Bundle\PostsBundle\PostsCategoryIndexGenerator A Sculpin\Bundle\PostsBundle\PostsCategoryIndexGenerator instance.
     */
    protected function getSculpinPosts_PostsCategoryIndexGeneratorService()
    {
        return $this->services['sculpin_posts.posts_category_index_generator'] = new \Sculpin\Bundle\PostsBundle\PostsCategoryIndexGenerator($this->get('sculpin.data_provider_manager'));
    }

    /**
     * Gets the 'sculpin_posts.posts_data_provider' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Bundle\PostsBundle\PostsDataProvider A Sculpin\Bundle\PostsBundle\PostsDataProvider instance.
     */
    protected function getSculpinPosts_PostsDataProviderService()
    {
        return $this->services['sculpin_posts.posts_data_provider'] = new \Sculpin\Bundle\PostsBundle\PostsDataProvider($this->get('sculpin.formatter_manager'), array(0 => '_posts'), 'pretty', true, $this->get('sculpin.matcher'));
    }

    /**
     * Gets the 'sculpin_posts.posts_tag_index_generator' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Bundle\PostsBundle\PostsTagIndexGenerator A Sculpin\Bundle\PostsBundle\PostsTagIndexGenerator instance.
     */
    protected function getSculpinPosts_PostsTagIndexGeneratorService()
    {
        return $this->services['sculpin_posts.posts_tag_index_generator'] = new \Sculpin\Bundle\PostsBundle\PostsTagIndexGenerator($this->get('sculpin.data_provider_manager'));
    }

    /**
     * Gets the 'sculpin_posts.posts_tags_data_provider' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Bundle\PostsBundle\PostsTagsDataProvider A Sculpin\Bundle\PostsBundle\PostsTagsDataProvider instance.
     */
    protected function getSculpinPosts_PostsTagsDataProviderService()
    {
        return $this->services['sculpin_posts.posts_tags_data_provider'] = new \Sculpin\Bundle\PostsBundle\PostsTagsDataProvider($this->get('sculpin.data_provider_manager'));
    }

    /**
     * Gets the 'sculpin_textile.converter' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Bundle\TextileBundle\TextileConverter A Sculpin\Bundle\TextileBundle\TextileConverter instance.
     */
    protected function getSculpinTextile_ConverterService()
    {
        return $this->services['sculpin_textile.converter'] = new \Sculpin\Bundle\TextileBundle\TextileConverter($this->get('sculpin_textile.parser'), array(0 => 'textile'));
    }

    /**
     * Gets the 'sculpin_textile.parser' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Netcarver\Textile\Parser A Netcarver\Textile\Parser instance.
     */
    protected function getSculpinTextile_ParserService()
    {
        return $this->services['sculpin_textile.parser'] = new \Netcarver\Textile\Parser();
    }

    /**
     * Gets the 'sculpin_twig.array_loader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Twig_Loader_Array A Twig_Loader_Array instance.
     */
    protected function getSculpinTwig_ArrayLoaderService()
    {
        return $this->services['sculpin_twig.array_loader'] = new \Twig_Loader_Array(array());
    }

    /**
     * Gets the 'sculpin_twig.flexible_extension_filesystem_loader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Bundle\TwigBundle\FlexibleExtensionFilesystemLoader A Sculpin\Bundle\TwigBundle\FlexibleExtensionFilesystemLoader instance.
     */
    protected function getSculpinTwig_FlexibleExtensionFilesystemLoaderService()
    {
        return $this->services['sculpin_twig.flexible_extension_filesystem_loader'] = new \Sculpin\Bundle\TwigBundle\FlexibleExtensionFilesystemLoader('/Users/Henrik/Code/Play/sculpin-blog/source', array(0 => '_views'), array(0 => '', 1 => 'twig', 2 => 'html', 3 => 'html.twig', 4 => 'twig.html'));
    }

    /**
     * Gets the 'sculpin_twig.formatter' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Bundle\TwigBundle\TwigFormatter A Sculpin\Bundle\TwigBundle\TwigFormatter instance.
     */
    protected function getSculpinTwig_FormatterService()
    {
        return $this->services['sculpin_twig.formatter'] = new \Sculpin\Bundle\TwigBundle\TwigFormatter($this->get('sculpin_twig.twig'), $this->get('sculpin_twig.array_loader'));
    }

    /**
     * Gets the 'sculpin_twig.loader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Twig_Loader_Chain A Twig_Loader_Chain instance.
     */
    protected function getSculpinTwig_LoaderService()
    {
        return $this->services['sculpin_twig.loader'] = new \Twig_Loader_Chain(array(0 => $this->get('sculpin_twig.flexible_extension_filesystem_loader'), 1 => $this->get('sculpin_twig.array_loader')));
    }

    /**
     * Gets the 'sculpin_twig.template_resetter' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sculpin\Bundle\TwigBundle\TemplateResetter A Sculpin\Bundle\TwigBundle\TemplateResetter instance.
     */
    protected function getSculpinTwig_TemplateResetterService()
    {
        return $this->services['sculpin_twig.template_resetter'] = new \Sculpin\Bundle\TwigBundle\TemplateResetter($this->get('sculpin_twig.twig'));
    }

    /**
     * Gets the 'sculpin_twig.twig' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Twig_Environment A Twig_Environment instance.
     */
    protected function getSculpinTwig_TwigService()
    {
        return $this->services['sculpin_twig.twig'] = new \Twig_Environment($this->get('sculpin_twig.loader'));
    }

    /**
     * Gets the 'service_container' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @throws RuntimeException always since this service is expected to be injected dynamically
     */
    protected function getServiceContainerService()
    {
        throw new RuntimeException('You have requested a synthetic service ("service_container"). The DIC does not know how to construct this service.');
    }

    /**
     * Gets the 'streamed_response_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\EventListener\StreamedResponseListener A Symfony\Component\HttpKernel\EventListener\StreamedResponseListener instance.
     */
    protected function getStreamedResponseListenerService()
    {
        return $this->services['streamed_response_listener'] = new \Symfony\Component\HttpKernel\EventListener\StreamedResponseListener();
    }

    /**
     * Gets the 'translation.dumper.csv' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Dumper\CsvFileDumper A Symfony\Component\Translation\Dumper\CsvFileDumper instance.
     */
    protected function getTranslation_Dumper_CsvService()
    {
        return $this->services['translation.dumper.csv'] = new \Symfony\Component\Translation\Dumper\CsvFileDumper();
    }

    /**
     * Gets the 'translation.dumper.ini' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Dumper\IniFileDumper A Symfony\Component\Translation\Dumper\IniFileDumper instance.
     */
    protected function getTranslation_Dumper_IniService()
    {
        return $this->services['translation.dumper.ini'] = new \Symfony\Component\Translation\Dumper\IniFileDumper();
    }

    /**
     * Gets the 'translation.dumper.mo' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Dumper\MoFileDumper A Symfony\Component\Translation\Dumper\MoFileDumper instance.
     */
    protected function getTranslation_Dumper_MoService()
    {
        return $this->services['translation.dumper.mo'] = new \Symfony\Component\Translation\Dumper\MoFileDumper();
    }

    /**
     * Gets the 'translation.dumper.php' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Dumper\PhpFileDumper A Symfony\Component\Translation\Dumper\PhpFileDumper instance.
     */
    protected function getTranslation_Dumper_PhpService()
    {
        return $this->services['translation.dumper.php'] = new \Symfony\Component\Translation\Dumper\PhpFileDumper();
    }

    /**
     * Gets the 'translation.dumper.po' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Dumper\PoFileDumper A Symfony\Component\Translation\Dumper\PoFileDumper instance.
     */
    protected function getTranslation_Dumper_PoService()
    {
        return $this->services['translation.dumper.po'] = new \Symfony\Component\Translation\Dumper\PoFileDumper();
    }

    /**
     * Gets the 'translation.dumper.qt' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Dumper\QtFileDumper A Symfony\Component\Translation\Dumper\QtFileDumper instance.
     */
    protected function getTranslation_Dumper_QtService()
    {
        return $this->services['translation.dumper.qt'] = new \Symfony\Component\Translation\Dumper\QtFileDumper();
    }

    /**
     * Gets the 'translation.dumper.res' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Dumper\IcuResFileDumper A Symfony\Component\Translation\Dumper\IcuResFileDumper instance.
     */
    protected function getTranslation_Dumper_ResService()
    {
        return $this->services['translation.dumper.res'] = new \Symfony\Component\Translation\Dumper\IcuResFileDumper();
    }

    /**
     * Gets the 'translation.dumper.xliff' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Dumper\XliffFileDumper A Symfony\Component\Translation\Dumper\XliffFileDumper instance.
     */
    protected function getTranslation_Dumper_XliffService()
    {
        return $this->services['translation.dumper.xliff'] = new \Symfony\Component\Translation\Dumper\XliffFileDumper();
    }

    /**
     * Gets the 'translation.dumper.yml' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Dumper\YamlFileDumper A Symfony\Component\Translation\Dumper\YamlFileDumper instance.
     */
    protected function getTranslation_Dumper_YmlService()
    {
        return $this->services['translation.dumper.yml'] = new \Symfony\Component\Translation\Dumper\YamlFileDumper();
    }

    /**
     * Gets the 'translation.extractor' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Extractor\ChainExtractor A Symfony\Component\Translation\Extractor\ChainExtractor instance.
     */
    protected function getTranslation_ExtractorService()
    {
        $this->services['translation.extractor'] = $instance = new \Symfony\Component\Translation\Extractor\ChainExtractor();

        $instance->addExtractor('php', $this->get('translation.extractor.php'));

        return $instance;
    }

    /**
     * Gets the 'translation.extractor.php' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\Translation\PhpExtractor A Symfony\Bundle\FrameworkBundle\Translation\PhpExtractor instance.
     */
    protected function getTranslation_Extractor_PhpService()
    {
        return $this->services['translation.extractor.php'] = new \Symfony\Bundle\FrameworkBundle\Translation\PhpExtractor();
    }

    /**
     * Gets the 'translation.loader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\Translation\TranslationLoader A Symfony\Bundle\FrameworkBundle\Translation\TranslationLoader instance.
     */
    protected function getTranslation_LoaderService()
    {
        $a = $this->get('translation.loader.xliff');

        $this->services['translation.loader'] = $instance = new \Symfony\Bundle\FrameworkBundle\Translation\TranslationLoader();

        $instance->addLoader('php', $this->get('translation.loader.php'));
        $instance->addLoader('yml', $this->get('translation.loader.yml'));
        $instance->addLoader('xlf', $a);
        $instance->addLoader('xliff', $a);
        $instance->addLoader('po', $this->get('translation.loader.po'));
        $instance->addLoader('mo', $this->get('translation.loader.mo'));
        $instance->addLoader('ts', $this->get('translation.loader.qt'));
        $instance->addLoader('csv', $this->get('translation.loader.csv'));
        $instance->addLoader('res', $this->get('translation.loader.res'));
        $instance->addLoader('dat', $this->get('translation.loader.dat'));
        $instance->addLoader('ini', $this->get('translation.loader.ini'));

        return $instance;
    }

    /**
     * Gets the 'translation.loader.csv' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Loader\CsvFileLoader A Symfony\Component\Translation\Loader\CsvFileLoader instance.
     */
    protected function getTranslation_Loader_CsvService()
    {
        return $this->services['translation.loader.csv'] = new \Symfony\Component\Translation\Loader\CsvFileLoader();
    }

    /**
     * Gets the 'translation.loader.dat' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Loader\IcuResFileLoader A Symfony\Component\Translation\Loader\IcuResFileLoader instance.
     */
    protected function getTranslation_Loader_DatService()
    {
        return $this->services['translation.loader.dat'] = new \Symfony\Component\Translation\Loader\IcuResFileLoader();
    }

    /**
     * Gets the 'translation.loader.ini' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Loader\IniFileLoader A Symfony\Component\Translation\Loader\IniFileLoader instance.
     */
    protected function getTranslation_Loader_IniService()
    {
        return $this->services['translation.loader.ini'] = new \Symfony\Component\Translation\Loader\IniFileLoader();
    }

    /**
     * Gets the 'translation.loader.mo' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Loader\MoFileLoader A Symfony\Component\Translation\Loader\MoFileLoader instance.
     */
    protected function getTranslation_Loader_MoService()
    {
        return $this->services['translation.loader.mo'] = new \Symfony\Component\Translation\Loader\MoFileLoader();
    }

    /**
     * Gets the 'translation.loader.php' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Loader\PhpFileLoader A Symfony\Component\Translation\Loader\PhpFileLoader instance.
     */
    protected function getTranslation_Loader_PhpService()
    {
        return $this->services['translation.loader.php'] = new \Symfony\Component\Translation\Loader\PhpFileLoader();
    }

    /**
     * Gets the 'translation.loader.po' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Loader\PoFileLoader A Symfony\Component\Translation\Loader\PoFileLoader instance.
     */
    protected function getTranslation_Loader_PoService()
    {
        return $this->services['translation.loader.po'] = new \Symfony\Component\Translation\Loader\PoFileLoader();
    }

    /**
     * Gets the 'translation.loader.qt' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Loader\QtFileLoader A Symfony\Component\Translation\Loader\QtFileLoader instance.
     */
    protected function getTranslation_Loader_QtService()
    {
        return $this->services['translation.loader.qt'] = new \Symfony\Component\Translation\Loader\QtFileLoader();
    }

    /**
     * Gets the 'translation.loader.res' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Loader\IcuResFileLoader A Symfony\Component\Translation\Loader\IcuResFileLoader instance.
     */
    protected function getTranslation_Loader_ResService()
    {
        return $this->services['translation.loader.res'] = new \Symfony\Component\Translation\Loader\IcuResFileLoader();
    }

    /**
     * Gets the 'translation.loader.xliff' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Loader\XliffFileLoader A Symfony\Component\Translation\Loader\XliffFileLoader instance.
     */
    protected function getTranslation_Loader_XliffService()
    {
        return $this->services['translation.loader.xliff'] = new \Symfony\Component\Translation\Loader\XliffFileLoader();
    }

    /**
     * Gets the 'translation.loader.yml' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Loader\YamlFileLoader A Symfony\Component\Translation\Loader\YamlFileLoader instance.
     */
    protected function getTranslation_Loader_YmlService()
    {
        return $this->services['translation.loader.yml'] = new \Symfony\Component\Translation\Loader\YamlFileLoader();
    }

    /**
     * Gets the 'translation.writer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Writer\TranslationWriter A Symfony\Component\Translation\Writer\TranslationWriter instance.
     */
    protected function getTranslation_WriterService()
    {
        $this->services['translation.writer'] = $instance = new \Symfony\Component\Translation\Writer\TranslationWriter();

        $instance->addDumper('php', $this->get('translation.dumper.php'));
        $instance->addDumper('xlf', $this->get('translation.dumper.xliff'));
        $instance->addDumper('po', $this->get('translation.dumper.po'));
        $instance->addDumper('mo', $this->get('translation.dumper.mo'));
        $instance->addDumper('yml', $this->get('translation.dumper.yml'));
        $instance->addDumper('ts', $this->get('translation.dumper.qt'));
        $instance->addDumper('csv', $this->get('translation.dumper.csv'));
        $instance->addDumper('ini', $this->get('translation.dumper.ini'));
        $instance->addDumper('res', $this->get('translation.dumper.res'));

        return $instance;
    }

    /**
     * Gets the 'translator' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\IdentityTranslator A Symfony\Component\Translation\IdentityTranslator instance.
     */
    protected function getTranslatorService()
    {
        return $this->services['translator'] = new \Symfony\Component\Translation\IdentityTranslator($this->get('translator.selector'));
    }

    /**
     * Gets the 'translator.default' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\Translation\Translator A Symfony\Bundle\FrameworkBundle\Translation\Translator instance.
     */
    protected function getTranslator_DefaultService()
    {
        return $this->services['translator.default'] = new \Symfony\Bundle\FrameworkBundle\Translation\Translator($this, $this->get('translator.selector'), array('translation.loader.php' => array(0 => 'php'), 'translation.loader.yml' => array(0 => 'yml'), 'translation.loader.xliff' => array(0 => 'xlf', 1 => 'xliff'), 'translation.loader.po' => array(0 => 'po'), 'translation.loader.mo' => array(0 => 'mo'), 'translation.loader.qt' => array(0 => 'ts'), 'translation.loader.csv' => array(0 => 'csv'), 'translation.loader.res' => array(0 => 'res'), 'translation.loader.dat' => array(0 => 'dat'), 'translation.loader.ini' => array(0 => 'ini')), array('cache_dir' => '/Users/Henrik/Code/Play/sculpin-blog/app/cache/dev/translations', 'debug' => true));
    }

    /**
     * Gets the 'uri_signer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\UriSigner A Symfony\Component\HttpKernel\UriSigner instance.
     */
    protected function getUriSignerService()
    {
        return $this->services['uri_signer'] = new \Symfony\Component\HttpKernel\UriSigner('unicorns-are-not-transsexual');
    }

    /**
     * Gets the 'translator.selector' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Component\Translation\MessageSelector A Symfony\Component\Translation\MessageSelector instance.
     */
    protected function getTranslator_SelectorService()
    {
        return $this->services['translator.selector'] = new \Symfony\Component\Translation\MessageSelector();
    }

    /**
     * {@inheritdoc}
     */
    public function getParameter($name)
    {
        $name = strtolower($name);

        if (!array_key_exists($name, $this->parameters)) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }

        return $this->parameters[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function hasParameter($name)
    {
        return array_key_exists(strtolower($name), $this->parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

    /**
     * {@inheritDoc}
     */
    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $this->parameterBag = new FrozenParameterBag($this->parameters);
        }

        return $this->parameterBag;
    }
    /**
     * Gets the default parameters.
     *
     * @return array An array of the default parameters
     */
    protected function getDefaultParameters()
    {
        return array(
            'kernel.root_dir' => '/Users/Henrik/Code/Play/sculpin-blog/app',
            'kernel.environment' => 'dev',
            'kernel.debug' => true,
            'kernel.name' => 'app',
            'kernel.cache_dir' => '/Users/Henrik/Code/Play/sculpin-blog/app/cache/dev',
            'kernel.logs_dir' => '/Users/Henrik/Code/Play/sculpin-blog/app/logs',
            'kernel.bundles' => array(
                'SculpinStandaloneBundle' => 'Sculpin\\Bundle\\StandaloneBundle\\SculpinStandaloneBundle',
                'DflydevEmbeddedComposerBundle' => 'Dflydev\\EmbeddedComposer\\Bundle\\DflydevEmbeddedComposerBundle',
                'SculpinMarkdownBundle' => 'Sculpin\\Bundle\\MarkdownBundle\\SculpinMarkdownBundle',
                'SculpinTextileBundle' => 'Sculpin\\Bundle\\TextileBundle\\SculpinTextileBundle',
                'SculpinMarkdownTwigCompatBundle' => 'Sculpin\\Bundle\\MarkdownTwigCompatBundle\\SculpinMarkdownTwigCompatBundle',
                'SculpinPaginationBundle' => 'Sculpin\\Bundle\\PaginationBundle\\SculpinPaginationBundle',
                'SculpinPostsBundle' => 'Sculpin\\Bundle\\PostsBundle\\SculpinPostsBundle',
                'SculpinBundle' => 'Sculpin\\Bundle\\SculpinBundle\\SculpinBundle',
                'SculpinTwigBundle' => 'Sculpin\\Bundle\\TwigBundle\\SculpinTwigBundle',
                'FrameworkBundle' => 'Symfony\\Bundle\\FrameworkBundle\\FrameworkBundle',
            ),
            'kernel.charset' => 'UTF-8',
            'kernel.container_class' => 'appDevDebugProjectContainer',
            'sculpin.project_dir' => '/Users/Henrik/Code/Play/sculpin-blog',
            'sculpin_markdown.converter.class' => 'Sculpin\\Bundle\\MarkdownBundle\\MarkdownConverter',
            'sculpin_markdown.parser.class' => 'dflydev\\markdown\\MarkdownParser',
            'sculpin_textile.converter.class' => 'Sculpin\\Bundle\\TextileBundle\\TextileConverter',
            'sculpin_textile.parser.class' => 'Netcarver\\Textile\\Parser',
            'sculpin_markdown_twig_compat.convert_listener.class' => 'Sculpin\\Bundle\\MarkdownTwigCompatBundle\\ConvertListener',
            'sculpin_pagination.generator.class' => 'Sculpin\\Bundle\\PaginationBundle\\PaginationGenerator',
            'sculpin_pagination.max_per_page' => '10',
            'sculpin_posts.posts_data_provider.class' => 'Sculpin\\Bundle\\PostsBundle\\PostsDataProvider',
            'sculpin_posts.posts_tags_data_provider.class' => 'Sculpin\\Bundle\\PostsBundle\\PostsTagsDataProvider',
            'sculpin_posts.posts_tag_index_generator.class' => 'Sculpin\\Bundle\\PostsBundle\\PostsTagIndexGenerator',
            'sculpin_posts.posts_categories_data_provider.class' => 'Sculpin\\Bundle\\PostsBundle\\PostsCategoriesDataProvider',
            'sculpin_posts.posts_category_index_generator.class' => 'Sculpin\\Bundle\\PostsBundle\\PostsCategoryIndexGenerator',
            'sculpin_posts.paths' => array(
                0 => '_posts',
            ),
            'sculpin_posts.permalink' => 'pretty',
            'sculpin_posts.publish_drafts' => true,
            'sculpin.matcher.class' => 'dflydev\\util\\antPathMatcher\\AntPathMatcher',
            'sculpin.site_configuration.class' => 'Dflydev\\DotAccessConfiguration\\Configuration',
            'sculpin.site_configuration_factory.class' => 'Sculpin\\Core\\SiteConfiguration\\SiteConfigurationFactory',
            'sculpin.writer.class' => 'Sculpin\\Core\\Output\\FilesystemWriter',
            'sculpin.data_provider_manager.class' => 'Sculpin\\Core\\DataProvider\\DataProviderManager',
            'sculpin.generator_manager.class' => 'Sculpin\\Core\\Generator\\GeneratorManager',
            'sculpin.formatter_manager.class' => 'Sculpin\\Core\\Formatter\\FormatterManager',
            'sculpin.converter_manager.class' => 'Sculpin\\Core\\Converter\\ConverterManager',
            'sculpin.class' => 'Sculpin\\Core\\Sculpin',
            'sculpin.data_source.class' => 'Sculpin\\Core\\Source\\CompositeDataSource',
            'sculpin.default_filesystem_data_source.class' => 'Sculpin\\Core\\Source\\FilesystemDataSource',
            'sculpin.source_permalink_factory.class' => 'Sculpin\\Core\\Permalink\\SourcePermalinkFactory',
            'sculpin.finder_factory.class' => 'Dflydev\\Symfony\\FinderFactory\\FinderFactory',
            'sculpin.configuration.path_configurator.class' => 'Sculpin\\Bundle\\SculpinBundle\\Sculpin\\Configuration\\PathConfigurator',
            'sculpin.source_dir' => '/Users/Henrik/Code/Play/sculpin-blog/source',
            'sculpin.output_dir' => '/Users/Henrik/Code/Play/sculpin-blog/output_dev',
            'sculpin.exclude' => array(
                0 => '_views/**',
            ),
            'sculpin.ignore' => array(

            ),
            'sculpin.raw' => array(

            ),
            'sculpin.permalink' => 'pretty',
            'sculpin_twig.flexible_extension_filesystem_loader.class' => 'Sculpin\\Bundle\\TwigBundle\\FlexibleExtensionFilesystemLoader',
            'sculpin_twig.array_loader.class' => 'Twig_Loader_Array',
            'sculpin_twig.loader.class' => 'Twig_Loader_Chain',
            'sculpin_twig.template_resetter.class' => 'Sculpin\\Bundle\\TwigBundle\\TemplateResetter',
            'sculpin_twig.twig.class' => 'Twig_Environment',
            'sculpin_twig.formatter.class' => 'Sculpin\\Bundle\\TwigBundle\\TwigFormatter',
            'sculpin_twig.view_paths' => array(
                0 => '_views',
            ),
            'sculpin_twig.extensions' => array(
                0 => '',
                1 => 'twig',
                2 => 'html',
                3 => 'html.twig',
                4 => 'twig.html',
            ),
            'controller_resolver.class' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\ControllerResolver',
            'controller_name_converter.class' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\ControllerNameParser',
            'response_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ResponseListener',
            'streamed_response_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\StreamedResponseListener',
            'locale_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\LocaleListener',
            'event_dispatcher.class' => 'Symfony\\Component\\EventDispatcher\\ContainerAwareEventDispatcher',
            'http_kernel.class' => 'Symfony\\Bundle\\FrameworkBundle\\HttpKernel',
            'filesystem.class' => 'Symfony\\Component\\Filesystem\\Filesystem',
            'cache_warmer.class' => 'Symfony\\Component\\HttpKernel\\CacheWarmer\\CacheWarmerAggregate',
            'cache_clearer.class' => 'Symfony\\Component\\HttpKernel\\CacheClearer\\ChainCacheClearer',
            'file_locator.class' => 'Symfony\\Component\\HttpKernel\\Config\\FileLocator',
            'uri_signer.class' => 'Symfony\\Component\\HttpKernel\\UriSigner',
            'http_content_renderer.class' => 'Symfony\\Component\\HttpKernel\\HttpContentRenderer',
            'http_content_renderer.strategy.default.class' => 'Symfony\\Component\\HttpKernel\\RenderingStrategy\\DefaultRenderingStrategy',
            'http_content_renderer.strategy.hinclude.class' => 'Symfony\\Bundle\\FrameworkBundle\\RenderingStrategy\\ContainerAwareHIncludeRenderingStrategy',
            'http_content_renderer.strategy.hinclude.global_template' => '',
            'http_content_renderer.proxy_path' => '/_proxy',
            'translator.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\Translator',
            'translator.identity.class' => 'Symfony\\Component\\Translation\\IdentityTranslator',
            'translator.selector.class' => 'Symfony\\Component\\Translation\\MessageSelector',
            'translation.loader.php.class' => 'Symfony\\Component\\Translation\\Loader\\PhpFileLoader',
            'translation.loader.yml.class' => 'Symfony\\Component\\Translation\\Loader\\YamlFileLoader',
            'translation.loader.xliff.class' => 'Symfony\\Component\\Translation\\Loader\\XliffFileLoader',
            'translation.loader.po.class' => 'Symfony\\Component\\Translation\\Loader\\PoFileLoader',
            'translation.loader.mo.class' => 'Symfony\\Component\\Translation\\Loader\\MoFileLoader',
            'translation.loader.qt.class' => 'Symfony\\Component\\Translation\\Loader\\QtFileLoader',
            'translation.loader.csv.class' => 'Symfony\\Component\\Translation\\Loader\\CsvFileLoader',
            'translation.loader.res.class' => 'Symfony\\Component\\Translation\\Loader\\IcuResFileLoader',
            'translation.loader.dat.class' => 'Symfony\\Component\\Translation\\Loader\\IcuDatFileLoader',
            'translation.loader.ini.class' => 'Symfony\\Component\\Translation\\Loader\\IniFileLoader',
            'translation.dumper.php.class' => 'Symfony\\Component\\Translation\\Dumper\\PhpFileDumper',
            'translation.dumper.xliff.class' => 'Symfony\\Component\\Translation\\Dumper\\XliffFileDumper',
            'translation.dumper.po.class' => 'Symfony\\Component\\Translation\\Dumper\\PoFileDumper',
            'translation.dumper.mo.class' => 'Symfony\\Component\\Translation\\Dumper\\MoFileDumper',
            'translation.dumper.yml.class' => 'Symfony\\Component\\Translation\\Dumper\\YamlFileDumper',
            'translation.dumper.qt.class' => 'Symfony\\Component\\Translation\\Dumper\\QtFileDumper',
            'translation.dumper.csv.class' => 'Symfony\\Component\\Translation\\Dumper\\CsvFileDumper',
            'translation.dumper.ini.class' => 'Symfony\\Component\\Translation\\Dumper\\IniFileDumper',
            'translation.dumper.res.class' => 'Symfony\\Component\\Translation\\Dumper\\IcuResFileDumper',
            'translation.extractor.php.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\PhpExtractor',
            'translation.loader.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\TranslationLoader',
            'translation.extractor.class' => 'Symfony\\Component\\Translation\\Extractor\\ChainExtractor',
            'translation.writer.class' => 'Symfony\\Component\\Translation\\Writer\\TranslationWriter',
            'debug.event_dispatcher.class' => 'Symfony\\Component\\HttpKernel\\Debug\\TraceableEventDispatcher',
            'debug.stopwatch.class' => 'Symfony\\Component\\Stopwatch\\Stopwatch',
            'debug.container.dump' => '/Users/Henrik/Code/Play/sculpin-blog/app/cache/dev/appDevDebugProjectContainer.xml',
            'debug.controller_resolver.class' => 'Symfony\\Component\\HttpKernel\\Controller\\TraceableControllerResolver',
            'debug.deprecation_logger_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\DeprecationLoggerListener',
            'kernel.secret' => 'unicorns-are-not-transsexual',
            'kernel.trusted_proxies' => array(

            ),
            'kernel.trust_proxy_headers' => false,
            'kernel.default_locale' => 'en',
            'annotations.reader.class' => 'Doctrine\\Common\\Annotations\\AnnotationReader',
            'annotations.cached_reader.class' => 'Doctrine\\Common\\Annotations\\CachedReader',
            'annotations.file_cache_reader.class' => 'Doctrine\\Common\\Annotations\\FileCacheReader',
        );
    }
}
