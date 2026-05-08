<?php

namespace App\Repositories;

use App\Interfaces\NotificationRepositoryInterface;
use Override;

class NotificationRepository implements NotificationRepositoryInterface

{
        #[Override]
        public function all(array $filters = [])
        {
            throw new \Exception('Not implemented');
        }

        #[Override]
        public function paginate(int $perPage = 15)
        {
            throw new \Exception('Not implemented');
        }
        #[Override]
        public function findById(int $id)
        {
            throw new \Exception('Not implemented');
        }

        #[Override]
        public function findByUuid(string $uuid)
        {
            throw new \Exception('Not implemented');
        }

        #[Override]
        public function create(array $data)
        {
            throw new \Exception('Not implemented');
        }


        #[Override]
        public function update(int $id, array $data)
        {
            throw new \Exception('Not implemented');
        }

    
        #[Override]
        public function markAsRead(int $id)
        {
            throw new \Exception('Not implemented');
        }
       
        #[Override]
        public function delete(int $id)
        {
            throw new \Exception('Not implemented');
        }


        #[Override]
        public function notificationsByUser(int $userId)
        {
            throw new \Exception('Not implemented');
        }
      
        #[Override]
        public function unreadNotifications()
        {
            throw new \Exception('Not implemented');
        }
        
     
        
}