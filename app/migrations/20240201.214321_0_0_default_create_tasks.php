<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefaultD3eaafc84fcec747babd69f1c8cf282a extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('tasks')
            ->addColumn('id', 'primary', ['nullable' => false, 'defaultValue' => null])
            ->addColumn('title', 'string', ['nullable' => false, 'defaultValue' => null, 'size' => 255])
            ->addColumn('status', 'string', ['nullable' => false, 'defaultValue' => 'uncompleted', 'size' => 255])
            ->setPrimaryKeys(['id'])
            ->create();

        $this->database()
            ->table('tasks')
            ->insertMultiple(
                ['title'],
                [
                    ['Lorem ipsum dolor sit amet, consectetur adipiscing elit.'],
                    ['In vel metus non nulla imperdiet aliquam.'],
                    ['Praesent mollis odio in eleifend hendrerit.'],
                    ['Aenean tristique tortor eu metus congue commodo.'],
                ]
            );
    }

    public function down(): void
    {
        $this->table('tasks')->drop();
    }
}
