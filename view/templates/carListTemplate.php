<section>
    <div class="cars">
        <?php
            $cars = CarService::findAllCars();
            $row = 1;
            $col = 1;
            //col: 1/2 2/3
            //row: n/n+1
            if($type == 'myCars' || $type == 'deleteCar'){
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
                            <li><span>Üzemanyag:</span>'.$car->getFuelTypeHun().'</li>
                            <li><span>Állapot:</span>'.$car->getConditionHun().'</li>
                            <li><span>Telefon:</span><br><i>'.$phone.'</i></li>
                            <li><span>Elérhető ekkortól:</span><br>'.$car->getRentFrom().'</li>
                        </ul>
                </div>
                <div class="edit"><a href="'.UrlUtil::getRoutedUrl(UrlUtil::NAV_CAR_MODIFY).'&carId='.$car->getCarId().'">Módosítás</a></div>
                <div class="delete"><a href="'.UrlUtil::getRoutedUrl(UrlUtil::NAV_CAR_DELETE).'&carId='.$car->getCarId().'">Töröl</a></div>
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

                if($type == 'deleteCar'){
                    echo '<div class="overlay">
                            <div class="popup">
                                <p>Biztosan törli az autót?</p>
                                <div class="buttons">
                                <a href="'.UrlUtil::getRoutedUrl(UrlUtil::NAV_MY_CARS).'">
                                    <button class="cancel" type="submit">Mégse</button>
                                </a>
                                <form method="post" action="'.UrlUtil::MAIN_URL.'">
                                <input type="hidden" name="carId" value="'.$carId.'">
                                <input type="hidden" name="operation" value="' . UrlUtil::OPERATION_CAR_DELETE . '"/>
                                <button class="confirm" type="submit">Törlés</button>
                                </form>
                                
                                </div>
                            </div>
                        </div>';
                }
            }
            else{
                foreach ($cars as $car){
                    echo '<div class="card" style="grid-row: '.$row.'/'.($row+1).'; grid-column: '.$col.'/'.($col+1).';">
                <img src="assets/img/car1.jpg" alt="'.$car->getBrand().' '.$car->getName().'" usemap="#map">
                    <div class="info">
                        <ul>
                            <li class="type"><b>'.$car->getBrand().' '.$car->getName().'</b><hr></li>
                            <li><span>Üzemanyag:</span>'.$car->getFuelTypeHun().'</li>
                            <li><span>Állapot:</span>'.$car->getConditionHun().'</li>
                            <li><span>Telefon:</span><br><i>'.($type=='no'?'---------':CarService::findPhoneNumber($car)).'</i></li>
                            <li><span>Elérhető ekkortól:</span><br>'.$car->getRentFrom().'</li>
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