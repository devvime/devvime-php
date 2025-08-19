<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Users extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('users');
        $table
            ->addColumn('name', 'string')
            ->addColumn('email', 'string')
            ->addIndex('email', ['unique' => true])
            ->addColumn('password', 'string')
            ->addColumn('avatar', 'string')
            ->addColumn('super_user', 'boolean', ['default' => 0])
            ->addColumn('active', 'boolean', ['default' => 0])
            ->addTimestamps()
            ->create();
    }
}
