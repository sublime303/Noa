<?php

#todo make class?  :) 

echo "\n-------------------------------";
echo "\nMultiplication table trainer";
echo "\n learns hard tables";
echo "\n-------------------------------";




$results = run_multi_ai();
report($results);


function run_multi_ai(){
	echo "\nMultiplication AI mode";
	echo "\n quits when 5 correct in a row";
	echo "\n re-tests failing factors";

	$timer = array_sum(explode(' ', microtime())); #timer
	
	$num_questions = 4;
	$right = 0;
	$wrong = 0;
	$hardfactors = array();

	for ($i = 1;$i < $num_questions +1  ;$i++){
		$timer_q = array_sum(explode(' ', microtime())); #timer

		$a = rand(2,9);
		$b = rand(2,9);

		if(count($hardfactors) > 0){
			echo "\nQuestion[$i/$num_questions] Hardfactors[".count($hardfactors)."]  ->";
			foreach ($hardfactors as $key => $value) {
				echo " $value";
			}
			$a = array_pop($hardfactors); #move a faktor from array to next question
		}

		$svar = $a*$b;

		echo "\n$a x $b = ";
		$input = trim(input());
		#echo "\n du sa ".$input;

		if( $input == $svar){
			#echo " yes!";
			$right++;
			$results[$i]['result'] = 'Correct';
		}else{
			$wrong++;
			echo " Fail.. ($svar)";
			$results[$i]['result'] = 'Fail';
			$hardfactors[]=$a;
			$hardfactors[]=$b;
			$num_questions = $num_questions + 2; #add another question to the loop

		}
		
		$results[$i]['question'] = "$a x $b = $svar ($input)";
		$results[$i]['delay'] = 100*round(  array_sum(explode(' ', microtime())) - $timer_q ,2); #ms (millseconds)

		unset($input);
	}

	$results['testreport']['total_time_ms'] = 100*round(  array_sum(explode(' ', microtime())) - $timer ,2); #ms (millseconds)
	$results['testreport']['correct'] = $right;
	$results['testreport']['questions'] = $num_questions;
	$results['testreport']['correct_procent'] = round(100*($right/$num_questions));

	echo "\n\n---------------------------";
	echo "\n\n[$right/$num_questions] correct";
	echo "\n\n---------------------------";

	return $results;
}



function report($results){
	#todo
	#support results in json / serialized /  string  to support old saved resulats form db/file
	#
	echo "\nreport";
	if (is_array($results)){
		foreach ($results as $k => $v) {
			foreach ($v as $key => $value) {
				echo "\n$key: $value";
			}
		}
	}

}




function input(){
	unset($input);
	$handle = fopen ("php://stdin","r");
	$input = fgets($handle);
	fclose($handle);
	return $input;
	// $x  = stripcslashes(trim($input));
	// return  str_replace(array("\n", "\r"), '', $x);
}






function run_multi(){
	echo "\nMultiplication fixed num questiions\n";
	$timer = array_sum(explode(' ', microtime())); #timer
	
	$num_questions = 4;
	$right = 0;
	$wrong = 0;
	

	for ($i = 1;$i < $num_questions +1  ;$i++){
		$timer_q = array_sum(explode(' ', microtime())); #timer

		$a = rand(2,9);
		$b = rand(2,9);
		$svar = $a*$b;

		echo "\n$a x $b = ";
		$input = trim(input());
		#echo "\n du sa ".$input;

		if( $input == $svar){
			#echo " yes!";
			$right++;
			$results[$i]['result'] = 'Correct';
		}else{
			$wrong++;
			echo " Fail.. ($svar)";
			$results[$i]['result'] = 'Fail';
		}
		
		$results[$i]['question'] = "$a x $b = $svar ($input)";
		$results[$i]['delay'] = 100*round(  array_sum(explode(' ', microtime())) - $timer_q ,2); #ms (millseconds)

		unset($input);
	}

	$results['testreport']['total_time_ms'] = 100*round(  array_sum(explode(' ', microtime())) - $timer ,2); #ms (millseconds)
	$results['testreport']['correct'] = $right;
	$results['testreport']['questions'] = $num_questions;
	$results['testreport']['correct_procent'] = round(100*($right/$num_questions));

	echo "\n\n---------------------------";
	echo "\n\n[$right/$num_questions] correct";
	echo "\n\n---------------------------";

	return $results;
}

