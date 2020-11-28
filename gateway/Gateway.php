<?php

    class Gateway{
        protected $con;
        
        function __construct(Connection $con){
            $this->con=$con;
        }
}