<?php
/**
 * Minds Entity
 * 
 * @version 1
 * @author Mark Harding
 */
namespace minds\pages\api\v1\entities;

use Minds\Core;
use minds\entities;
use minds\interfaces;
use Minds\Api\Factory;

class entity implements interfaces\api{

    /**
     * Returns the entities
     * @param array $pages
     * 
     * API:: /v1/entities/entity/:guid
     */      
    public function get($pages){
        
        if(!isset($pages[0])){
            $response['status'] = 'error';
        } else {
            $entity = Core\entities::build(new entities\entity($pages[0]));
            if($entity instanceof \ElggEntity){
                $response['entity'] = $entity->export();
                $response['entity']['guid'] = (string) $entity->guid;
                if($entity->entityObj){
                    $response['entity']['entityObj']['guid'] = (string) $entity->entityObj->guid;
                }
                if($entity->type == "object"){
                    $response['entity']['thumbnail_src'] = $entity->getIconUrl();
                    $response['entity']['perma_url'] = $entity->getURL();
                }
            }
        }

        return Factory::response($response);
        
    }
    
    public function post($pages){}
    
    public function put($pages){}
    
    public function delete($pages){}
    
}
        
