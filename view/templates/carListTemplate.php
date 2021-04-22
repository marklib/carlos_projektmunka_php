<section>
    <div class="cars">
        <?php
            $cars = CarService::findAllCars();
            $row = 1;
            $col = 1;
            //col: 1/2 2/3
            //row: n/n+1
            if($type == 'myCars'){
                $phone = UserService::getLoggedInUser()->getPhoneNumber();
                $id = UserService::getLoggedInUser()->getId();

                //echo '<div class="newCar-sidebar">
                //            <a href="newCar.html">Autó hozzáadása</a>
                //    </div>';

                foreach ($cars as $car){
                    if($car->getUserId() == $id){
                        echo '<div class="card" style="grid-row: '.$row.'/'.($row+1).'; grid-column: '.$col.'/'.($col+1).';">
                <img src="assets/img/car1.jpg" alt="'.$car->getBrand().' '.$car->getName().'" usemap="#map">
                    <div class="info">
                        <ul>
                            <li class="type"><b>'.$car->getBrand().' '.$car->getName().'</b><hr></li>
                            <li><span>Üzemanyag:</span>'.$car->getFuelType().'</li>
                            <li><span>Állapot:</span>'.$car->getCondition().'<br></li>
                            <li><span>Telefon:</span><br><i>'.$phone.'</i></li>
                        </ul>
                </div>
                <div class="edit"><a href="'.UrlUtil::getRoutedUrl(UrlUtil::NAV_CAR_MODIFY).'&carId='.$car->getCarId().'">Módosítás</a></div>
                <div class="delete"><a href="#">Töröl</a></div>
                </div>';
                        if($col == 1) {
                            $col=2;
                        }
                        else{
                            $col = 1;
                            $row++;
                        }
                    }
                }
            }
            else{
                foreach ($cars as $car){
                    echo '<div class="card" style="grid-row: '.$row.'/'.($row+1).'; grid-column: '.$col.'/'.($col+1).';">
                <img src="assets/img/car1.jpg" alt="'.$car->getBrand().' '.$car->getName().'" usemap="#map">
                    <div class="info">
                        <ul>
                            <li class="type"><b>'.$car->getBrand().' '.$car->getName().'</b><hr></li>
                            <li><span>Üzemanyag:</span>'.$car->getFuelType().'</li>
                            <li><span>Állapot:</span>'.$car->getCondition().'<br></li>
                            <li><span>Telefon:</span><br><i>'.($type=='no'?'---------':CarService::findPhoneNumber($car)).'</i></li>
                        </ul>
                </div>
                </div>';
                    if($col == 1) {
                        $col=2;
                    }
                    else{
                        $col = 1;
                        $row++;
                    }

                }
            }

        ?>
    </div>
    <map name="map">
        <area shape="rect" title="Üzemanyag" coords="0,0,125,250" href="#" alt="Üzemanyag">
        <area shape="rect" title="Állapot" coords="125,0,250,250" href="#" alt="Állapot">
    </map>
</section>