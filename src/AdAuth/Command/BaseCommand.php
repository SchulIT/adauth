<?php

namespace AdAuth\Command;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\DocParser;
use JMS\Serializer\JsonSerializationVisitor;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\Console\Command\Command;

abstract class BaseCommand extends Command {
    public function getSerializer() {
        AnnotationRegistry::registerAutoloadNamespace('JMS\Serializer\Annotation', __DIR__ . '/../../../vendor/jms/serializer/src');

        $jsonVisitor = new JsonSerializationVisitor(new IdenticalPropertyNamingStrategy());
        $jsonVisitor->setOptions(JSON_PRETTY_PRINT);

        $serializer = SerializerBuilder::create()
            ->setAnnotationReader(new AnnotationReader(new DocParser()))
            ->addDefaultDeserializationVisitors()
            ->addDefaultSerializationVisitors()
            ->setSerializationVisitor('json', $jsonVisitor)
            ->build();

        return $serializer;
    }
}