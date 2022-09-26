	<div id="dateHolder">
		
		<button class="navigators" id="backNavigator"><</button>
 				
		<button class="navigators" id="frontNavigator">></button>
 				
 		<select id="sltDay">
 					
 			<?php
 						
 				$i = 1;
 						
 				while($i < 32) {
 					
 					echo '<option ' . (($i == date("d")) ? "selected" : "") . '>' . ((strlen($i) == 1) ? ("0" . $i) : $i) . '</option>';
 							
 					$i++;
 						
 				}
 						
 			?>
 				
 		</select>
 				
 		<select id="sltMonth">
 					
 			<?php
 						
 				$i = 1;
 						
 				while($i < 13) {
 						
 					echo '<option ' . (($i == date("m")) ? "selected" : "") . '>' . ((strlen($i) == 1) ? ("0" . $i) : $i) . '</option>';
 							
 					$i++;
 						
 				}
 						
 			?>
 				
 		</select>
 				
 		<select id="sltYear">
 					
 			<?php
 				
 				$i = -10;
 						
 				$year = date("Y");
 						
 				while($i < 21) {
 						
 					$eachYear = ($year + $i);
 						
 					echo '<option ' . (($eachYear == $year) ? "selected" : "") . '>' . $eachYear . '</option>';
 							
 					$i++;
 						
 				}
 						
 			?>
 				
 		</select>
 				
	</div>