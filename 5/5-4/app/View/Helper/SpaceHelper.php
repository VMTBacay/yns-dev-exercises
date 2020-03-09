<?php
class SpaceHelper extends AppHelper {
    public function spaceMaker() {
        for ($i = 0; $i < 5; $i++) {
            echo '&nbsp;';
        }
    }
}