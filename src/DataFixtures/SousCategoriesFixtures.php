<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\SousCategories;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class SousCategoriesFixtures extends Fixture
{
    
    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
            $this->createCategory('PC', $manager);  
            $this->createCategory('Souris', $manager);
            $this->createCategory('Clavier', $manager);
            $this->createCategory('Hommes', $manager);
            $this->createCategory('Femmes', $manager);  
            $this->createCategory('Enfants', $manager);
            $this->createCategory('Machine à laver', $manager);
            $this->createCategory('Four', $manager);
            $this->createCategory('Lave-linge', $manager);  
            $this->createCategory('Jeux', $manager);
            $this->createCategory('Console', $manager);
            $this->createCategory('Assesoires', $manager);
           
            $manager->flush();
        }
    
        public function createCategory(string $name, ObjectManager $manager){
            $category = new SousCategories;
            $category->setName($name);
            $category->setSlug($this->slugger->slug($category->getName())->lower());
            $manager->persist($category);
    
            return $category;
        
    }
}

