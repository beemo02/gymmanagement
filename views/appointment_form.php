<?php

include_once "../controller/AppointmentController.php";
include_once "../model/Trainer.php";
include_once "../include/db.php";
include_once "../include/header.php";
include_once "../gymlife-master/index.php";

if(empty($_SESSION['token'])){
    $_SESSION['form_token'] = bin2hex(random_bytes(32));
}


?>




                    <form style="margin-top: 100px" id="appointmentForm" action="../gymlife-master/index.php?action=store_appointment" method="POST">
                        <div class="form-group">
                            <!-- Date input -->
                             <div class="form-group">
                                <label for="appointmentDate">Appointment Date</label>
                                <input type="datetime-local" class="form-control" id="appointmentDate" name="appointment_date" required>
                            </div>
                            
                            <!-- Select Trainer Dropdown -->
                            <div class="form-group">
                                <label for="trainerSelect">Select Trainer</label>
                                <select class="form-control" id="trainerSelect" name="trainer_id" required>
                                <?php 
                                        include_once "../include/db.php";
                                        include_once "../model/Trainer.php";
                                        
                                        $trainers = new Trainer($dbh);
                                        $train = $trainers->listTrainer();
                                        
                                        foreach($train as $trainer):
                                    ?>
                                    <option>
                                        <p>Select Option</p>
                                    </option>
                                    <option value="<?= htmlspecialchars($trainer['trainer_id']) ?>">
                                        <?= $trainer['trainer_name']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit">Enroll Now</button>
                            </div>
                        </form>

                        <script src="../gymlife-master/js/jquery-3.3.1.min.js"></script>

<?php include_once "../include/footer.php";       
