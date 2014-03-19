<?php

class FOLLOWER {
        
        function follow($data) {
            $prepared = $this->_conn->prepare("SELECT FollowerId FROM Followers WHERE UserId =:userId AND FollowedId =:followedId AND FollowedType =:followedType");
            $result   = $prepared->execute(
                    array (
                       'userId'       => $data['UserId'],
                       'followedId'   => $data['FollowedId'],
                       'followedType' => $data['FollowedType']
                    )
            ); 
            if ($prepared->rowCount() == 0) $this->saveArray($data);
        }
        
        function unfollow($userId, $followedId, $followedType) {
		$prepared = $this->_conn->prepare("DELETE FROM Followers WHERE UserId =:userId AND FollowedId =:followedId AND FollowedType =:followedType");
		$result   = $prepared->execute(
                     array (
                        'userId'       => $userId,
                        'followedId'   => $followedId,
                        'followedType' => $followedType
                     )
                );            
        }
        
        function getFollowers($followedId, $followedType, $limitClause="") {
            $prepared = $this->_conn->prepare("SELECT * FROM Followers WHERE FollowedId =:followedId AND FollowedType =:followedType $limitClause");
            $result   = $prepared->execute(
                 array (
                    'followedId'   => $followedId,
                    'followedType' => $followedType
                 )
            );
            return $prepared;
        }
        
        function getFollowedByUser($userId, $queryClause="", $orderClause="", $limitClause="") {
		$query    = "SELECT * FROM Followers WHERE UserId =:userId $queryClause $orderClause $limitClause";
                $prepared = $this->_conn->prepare($query);
		$result   = $prepared->execute(
                     array (
                        'userId'   => $userId
                     )
                );      
            return $prepared;
        }
        
        function getFollowLink ($userId, $followedId, $followedType, $buddy=false) {
         
               $root = WEB_ROOT;   
            
                if(($followedId != $userId) || ($followedId==$userId && $followedType!='USER'))
                { 
                        $prepared = $this->_conn->prepare("SELECT FollowerId FROM Followers WHERE UserId =:userId AND FollowedId =:followedId AND FollowedType =:followedType");
                        $result   = $prepared->execute(
                                array (
                                   'userId'       => $userId,
                                   'followedId'   => $followedId,
                                   'followedType' => $followedType
                                )
                        ); 

                        if($prepared->rowCount() > 0)
                        {
                                return "<span class='link' onclick=\"unfollow('$userId', '$followedId', '$followedType','$root','$buddy')\"> Unfollow " .ucfirst(strtolower($followedType)). "</span>";
                        }
                        else
                        {
                                return "<span class='link' onclick=\"follow('$userId', '$followedId', '$followedType','$root','$buddy')\"> Follow " .ucfirst(strtolower($followedType)). "</span>";
                        }				
                }
                else return false;
        }                   
}
