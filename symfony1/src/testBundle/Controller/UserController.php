<?php

namespace testBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Tests\Extension\Core\Type\SubmitTypeTest;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use testBundle\Entity\Director;
use testBundle\Entity\Pelicula;
use testBundle\Entity\Users;
use testBundle\Form\UsersType;
use testBundle\Entity\Product;


class UserController extends Controller {

    public function indexAction(Request $request)
    {

        $director = new Director();
        $director->setNombre("Nombre 1");
        $director->setApellido("ape 1");

        $form = $this->createFormBuilder($director)
            ->add('Nombre', TextType::class)
            ->add('save', SubmitTypeTest::class, array('label'=>'Create Director'))
        ->getForm();



       return $this->render('testBundle:Default:userindex.html.twig', array ('form'=>$form->createView()));

    }


    public function testInsertAction()
    {

        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('testBundle:Users')->findAll();

        $director = new Director();

        $director->setNombre("Nombre 1");

        $director->setApellido("ape 1");

        $pelicula = new Pelicula();

        $pelicula->setTitulo('Takecua parte 2');

        $pelicula->setDirector($director);

        $em->persist($director);

        $em->persist($pelicula);

        $em->flush();

        return $this->render('testBundle:Default:userindex.html.twig', array ('users'=>$users));
    }


    public function articlesAction ($page){

        return $this->render('testBundle:Default:userarticles.html.twig', array ('page'=>$page) );

    }

    public function addAction (){

        $user = new Users();
        $form = $this->createCreateForm($user);

        return $this->render('testBundle:Default:add.html.twig', array ('form'=>$form->createView()) );

    }

    private function createCreateForm(Users $user){

        $form = $this->createForm(new UsersType,$user, array(
            'action'=>$this->generateUrl('test_user_create'),
            'method'=>'POST'
        ));

        return $form;

    }

    public function editAction ($page){

        return $this->render('testBundle:Default:userarticles.html.twig', array ('page'=>$page) );

    }

    public function deleteAction ($page){

        return $this->render('testBundle:Default:userarticles.html.twig', array ('page'=>$page) );

    }

    public function viewAction ($id){

        $repository = $this->getDoctrine()->getRepository('testBundle:Users');

        //$user = $repository->find($id);
        $user = $repository->findOneBy(array('id'=>$id));

        return $this->render('testBundle:Default:userview.html.twig', array ('user'=>$user) );

    }










    public function ejemplos ()
    {
        $em = $this->getDoctrine()->getManager();


        $users = $em->getRepository('testBundle:Users')->findAll();

        $product = new Product();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');
        $product->setDescription('Lorem ipsum dolor');

        $em = $this->getDoctrine()->getManager();

        $em->persist($product);
        $em->flush();

        /*  $product = $this->getDoctrine()
        ->getRepository('AppBundle:Product')
        ->find($id);

    if (!$product) {
        throw $this->createNotFoundException(
            'No product found for id '.$id
        );
    }
        */
        $id = 1;
        $repository = $this->getDoctrine()
            ->getRepository('testBundle:Product');
        // query by the primary key (usually "id")
        $product = $repository->find($id);

// dynamic method names to find based on a column value
        $product = $repository->findOneById($id);
        $product = $repository->findOneByName('foo');

// find *all* products
        $products = $repository->findAll();

// find a group of products based on an arbitrary column value
        $products = $repository->findByPrice(19.99);

        // query for one product matching by name and price
        $product = $repository->findOneBy(
            array('name' => 'foo', 'price' => 19.99)
        );

// query for all products matching the name, ordered by price
        $products = $repository->findBy(
            array('name' => 'foo'),
            array('price' => 'ASC')
        );


        //updating an Object
        $product->setName('New product name!');
        $em->flush();


        //deleting and Object
        $em->remove($product);
        $em->flush();

        //mediante query
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
             FROM AppBundle:Product p
             WHERE p.price > :price
             ORDER BY p.price ASC'
        )->setParameter('price', '19.99');

        $products = $query->getResult();

        // to get just one result:
// $        product = $query->setMaxResults(1)->getOneOrNullResult();

        //If you're comfortable with SQL, then DQL should feel very natural.
        // The biggest difference is that you need to think in terms of "objects" instead of rows in a database. For this reason, you select from the AppBundle:Product object (an optional shortcut for AppBundle\Entity\Product) and then alias it as p.




        //Querying for Objects Using Doctrine's Query Builder

        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Product');

// createQueryBuilder automatically selects FROM AppBundle:Product
// and aliases it to "p"
        $query = $repository->createQueryBuilder('p')
            ->where('p.price > :price')
            ->setParameter('price', '19.99')
            ->orderBy('p.price', 'ASC')
            ->getQuery();

        $products = $query->getResult();
// to get just one result:
// $product = $query->setMaxResults(1)->getOneOrNullResult();


        /*para llamadas recurrentes crear un repositorio:

        src/AppBundle/Entity/ProductRepository.php
        namespace AppBundle\Entity;

        use Doctrine\ORM\EntityRepository;

        class ProductRepository extends EntityRepository
        {
            public function findAllOrderedByName()
                {
                    return $this->getEntityManager()
                       ->createQuery(
                     'SELECT p FROM AppBundle:Product p ORDER BY p.name ASC'
            )
            ->getResult();
    }
}



        Relaciones: claves foráneas




        // src/AppBundle/Entity/Product.php

// ...
class Product
{
    // ...

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")

        protected $category;
    }

    (falta el cierre del ORM manytoone, que es igual al cierre de este comentario)




$ php bin/console doctrine:schema:update --force







        public function createProductAction()
    {
        $category = new Category();
        $category->setName('Main Products');

        $product = new Product();
        $product->setName('Foo');
        $product->setPrice(19.99);
        $product->setDescription('Lorem ipsum dolor');
        // relate this product to the category
        $product->setCategory($category);

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->persist($product);
        $em->flush();

        return new Response(
            'Created product id: '.$product->getId()
            .' and category id: '.$category->getId()
        );
    }



            Fetching Related Objects

              $product = $this->getDoctrine()
        ->getRepository('AppBundle:Product')
        ->find($id);

            $categoryName = $product->getCategory()->getName();


        You can also query in the other direction:


        $category = $this->getDoctrine()
        ->getRepository('AppBundle:Category')
        ->find($id);

    $products = $category->getProducts();



    Of course, if you know up front that you'll need to access both objects, you can avoid the second query by issuing a join in the original query.
        Add the following method to the ProductRepository class:

        $query = $this->getEntityManager()
        ->createQuery(
            'SELECT p, c FROM AppBundle:Product p
            JOIN p.category c
            WHERE p.id = :id'
        )->setParameter('id', $id);

    try {
        return $query->getSingleResult();
    } catch (\Doctrine\ORM\NoResultException $e) {
        return null;
    }

    Now, you can use this method in your controller to query for a Product object and its related Category with just one query:

    $product = $this->getDoctrine()
        ->getRepository('AppBundle:Product')
        ->findOneByIdJoinedToCategory($id);

    $category = $product->getCategory();

 */


    }

}