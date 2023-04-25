<?php
// CALLED BY $_CORE->ROUTES->API()
// USE THIS TO OVERRIDE API CORS PERMISSION
// $this->origin : client origin, e.g. http://site.com
// $this->orihost : client origin host, e.g. site.com
// $this->mod : requested module. e.g. users
// $this->act : requested action. e.g. save