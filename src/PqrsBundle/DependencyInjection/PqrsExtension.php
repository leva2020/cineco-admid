<?php

namespace PqrsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class PqrsExtension extends Extension {

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container) {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\PhpFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.php');
        $loader->load('admin.yml');
        
        // S3
        if (!isset($config['amazon_s3']['aws_key'])) {
            throw new \InvalidArgumentException(
            'The option "pqrs.amazon_s3.aws_key" se debe establecer.'
            );
        }
        $container->setParameter(
                'pqrs.amazon_s3.aws_key', $config['amazon_s3']['aws_key']
        );

        if (!isset($config['amazon_s3']['aws_secret_key'])) {
            throw new \InvalidArgumentException(
            'The option "pqrs.amazon_s3.aws_secret_key" se debe establecer.'
            );
        }
        $container->setParameter(
                'pqrs.amazon_s3.aws_secret_key', $config['amazon_s3']['aws_secret_key']
        );

        if (!isset($config['amazon_s3']['base_url'])) {
            throw new \InvalidArgumentException(
            'The option "pqrs.amazon_s3.base_url" se debe establecer.'
            );
        }
        $container->setParameter(
                'pqrs.amazon_s3.base_url', $config['amazon_s3']['base_url']
        );
    }

}
