<?php

namespace App\Console\Migration;

use App\Console\ConsoleMigration;
use App\Entity\Product\ProductEntity;
use DateTime;
use Illuminate\Database\Schema\Blueprint;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductDatabase extends ConsoleMigration
{
    protected function getConnectionName(): string
    {
        return 'default';
    }

    /**
     * @return void
     */
    protected function configure() : void
    {
        $this->setName('app:create-database');
        $this->setDescription('Create the database of application');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->dropTables();
        $this->createTables();
        $this->insertProducts();

        return Command::SUCCESS;
    }

    /**
     * @return void
     */
    private function dropTables() : void
    {
        $this->schemaBuilder->dropIfExists('product');
        $this->schemaBuilder->dropIfExists('product_history');
    }

    /**
     * @return void
     */
    private function createTables() : void
    {
        if (!$this->schemaBuilder->hasTable('product')) {
            $this->schemaBuilder->create('product', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('name', 255)->unique()->nullable(false);

                $table->timestamps();
            });
        }

        if (!$this->schemaBuilder->hasTable('product_history')) {
            $this->schemaBuilder->create('product_history', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->foreignIdFor(ProductEntity::class);

                $table->float('price')->nullable(false);
                $table->string('description', 255)->nullable(false);

                $table->timestamps();
            });
        }
    }

    /**
     * @return void
     */
    private function insertProducts() : void
    {
        $date = new DateTime();

        $products = [
            'Arroz 5Kg',
            'Macarrão 1Kg',
            'Macarrão 500g',
            'Leite condensado',
            'Açúcar 5Kg',
            'Feijão 1Kg',
            'Cuzcuz 500g',
            'Farinha de trigo 1Kg',
            'Café 500g',
            'Óleo 900ml',
            'Goma de tapioca 1Kg',
            'Creme de leite 200g',
            'Bata palha 800g',
            'Vinagre 750ml',
            'Ketchup Heinz 1,03Kg',
            'Farinha Yoki temperada 250g',
            'Margarina 1Kg',
            'Margarina 500g',
            'Pão de forma',
            'Mortadela 200g',
            'Mussarela 500g',
            'Milho de pipoca 500g',
            'Lata de milho 200g',
            'Lata de ervilha 200g',
            'Cream cracker (pacote)',
            'Biscoito maizena (doce)',
            'Suco tang (uni)',
            'Fermento Royal 100g',
            'Fermento Royal 250g',
            'Maionese Heinz 390g',
            'Cookies de banana Nesfit 60g',
            'Leite 1L',
            'Iogurte grego',
            'Macarrão de lasanha',
            'Sal',
            'Molho de tomate 340g',
            'Azeite 500ml',
            'Copo descartável',
            'Saquinho de alimentos',




            'Creme dental 180g',
            'Creme dental 90g',
            'Escova de dente kit',
            'Sabonete lux 125g',
            'Shampoo gabriel',
            'Shampoo gabriele',
            'Shampoo nubia',
            'Shampoo',
            'Absorvente',
            'Contonete',
            'Algodão',




            'Detergente',
            'Água sanitária',
            'Álcool 70',
            'Desinfetante',
            'Bom ar',
            'Papel higiênico pacote com 12',
            'Baigon 360ml',
            'Amaciante 5L',
            'Bucha de lavar louça',
            'Saco de lixo 100L',
            'Papel toalha',
            'Bombril',
            'Sabão em pó',
            'Sabão em barra',
            'Limpardor multiuso (veja)',
        ];

        foreach ($products as $product) {
            $this->connection->table('product')->insert([
                'name' => $product,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}