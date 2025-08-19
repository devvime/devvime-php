<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class PasswordRecoveryTokens extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('password_recovery_tokens');
        $table
            ->addColumn('user_id', 'integer', ['signed' => false])
            ->addColumn('token', 'text')
            ->addColumn('valid', 'boolean', ['default' => 1])
            ->addTimestamps()
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->create();
    }
}
