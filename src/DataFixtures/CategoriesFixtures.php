<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use App\Entity\SousCategories;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoriesFixtures extends Fixture
{

    public function __construct(private SluggerInterface $slugger)
    {
        
    }
    public function load(ObjectManager $manager): void
    {
        $this->createCategory('Informatique', 'inf.jpg', $manager);  
        $this->createCategory('Mode','mode.jpg', $manager);
        $this->createCategory('Électroménager','electro.jpg', $manager);
        $this->createCategory('Jeux Vidéo','jeuvideo.webp', $manager);
       
        $manager->flush();
    }

    public function createCategory(string $name,string $image, ObjectManager $manager){
        $category = new Categories;
        $category->setName($name);
        $category->setImageName($image);
        $category->setSlug($this->slugger->slug($category->getName())->lower());
        $manager->persist($category);

        return $category;
    }
}
