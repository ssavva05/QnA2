function addQuestion(lid,ltitle,q,ta) {
	window.location.href="editQuestion.php?var="+lid+"&var1='"+ltitle+"'&question="+q+"&answer=1&totalans="+ta+"&action=1&r=0";
};
function deleteQuestion(q,ta){
	q--;
	window.location.href="myQuestions.php?var=1&var1=Title lala&question="+q+"&totalans="+ta;
};
function editQuestion(lid,ltitle,q,ta){
	window.location.href="editQuestion.php?var="+lid+"&var1='"+ltitle+"'&question="+q+"&answer=-1&totalans="+ta+"&action=0&r=0";
};