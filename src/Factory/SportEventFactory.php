<?php

namespace App\Factory;

use App\Entity\SportEvent;
use App\Repository\SportEventRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<SportEvent>
 *
 * @method        SportEvent|Proxy                     create(array|callable $attributes = [])
 * @method static SportEvent|Proxy                     createOne(array $attributes = [])
 * @method static SportEvent|Proxy                     find(object|array|mixed $criteria)
 * @method static SportEvent|Proxy                     findOrCreate(array $attributes)
 * @method static SportEvent|Proxy                     first(string $sortedField = 'id')
 * @method static SportEvent|Proxy                     last(string $sortedField = 'id')
 * @method static SportEvent|Proxy                     random(array $attributes = [])
 * @method static SportEvent|Proxy                     randomOrCreate(array $attributes = [])
 * @method static SportEventRepository|RepositoryProxy repository()
 * @method static SportEvent[]|Proxy[]                 all()
 * @method static SportEvent[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static SportEvent[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static SportEvent[]|Proxy[]                 findBy(array $attributes)
 * @method static SportEvent[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static SportEvent[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class SportEventFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'description' => self::faker()->text(),
            'entryFee' => self::faker()->randomNumber(),
            'isPublished' => self::faker()->boolean(),
            'name' => self::faker()->text(255),
            'popularityRating' => self::faker()->numberBetween(1, 10),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(SportEvent $sportEvent): void {})
        ;
    }

    protected static function getClass(): string
    {
        return SportEvent::class;
    }
}
