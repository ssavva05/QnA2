function addAnswer(q,a,ta,act){
		a++;
		window.location.href="editQuestion.php?var=1&var1=Title lala&question="+q+"&answer="+a+"&totalans="+ta+"&action="+act+"&r=1";
		
	};
 function deleteAnswer(q,a,ta,act){
		a--;
		window.location.href="editQuestion.php?var=1&var1=Title lala&question="+q+"&answer="+a+"&totalans="+ta+"&action="+act+"&r=1";
		
	};
function goBack(q,a,ta,act){
	if(act==1){
		q++;
	}
	ta+=a;
		window.location.href="myQuestions.php?var=1&var1=Title lala&question="+q+"&totalans="+ta;
	};
function deleteAllAnswers(q,ta,act){
	window.location.href="editQuestion.php?var=1&var1=Title lala&question="+q+"&answer=1"+"&totalans="+ta+"&action="+act+"&r=0";
	
};