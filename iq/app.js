var questions = [{
    question: "Which number should come next in the pattern?",
    choices: ["23", "24", "25", "26"],
    correctAnswer: 2 
},
{
    question: "Find the answer that best completes the analogy: Book is to Reading as Fork is to: ",
    choices: ["drawing", "writing", "stirring", "eating"],
    correctAnswer: 3
},
{
    question: "Find two words, one from each group, that are the closest in meaning:  Group A:talkative, job, ecstatic;Group B:angry, wind, loquacious",
    choices: ["talkative and wind", "job and angry", "talkative and loquacious", "ecstatic and angry"],
    correctAnswer: 2
},
{
    question: "Which of the following can be arranged into a 5-letter English word?",
    choices: ["H R G S T", "R I L S A", "T O O M T", "W Q R G S"],
    correctAnswer: 1
},
{
    question: "What number best completes the analogy: 8:4 as 10:",
    choices: ["3", "7", "24", "5"],
    correctAnswer: 3
},
{
    question: "If you rearrange the letters 'BARBIT' you would have the name of a:",
    choices: ["Continent", "City", "Ocean", "Animal"],
    correctAnswer: 3
},
{
    question: "A store reduced the price of one of its products by 25 percent. What percentage of the reduced price must it be increased by to put the product back to its original price?",
    choices: ["33%", "20%", "23%", "35%"],
    correctAnswer: 0
},
{
    question: "Which one of the five makes the best comparison? Brother is to sister as niece is to:",
    choices: ["Mother", "Daughter", "Uncle", "Nephew"],
    correctAnswer: 3
},
{
    question: "Which of the following words is closest in meaning to APPREHENSIVE?",
    choices: ["Anxious", "Thorough", "Foolish", "Comprehensive"],
    correctAnswer: 0
},
{
    question: "Nia,  twelve years old, is three times as old as her sister. How old will Nia be when she is twice as old as her sister?",
    choices: ["15", "16", "20", "21"],
    correctAnswer: 1
},
{
    question: "The price of an article was cut 20% for sale.  By what percent must the discounted item be increased to again sell the article at the original price?",
    choices: ["15%", "20%", "25%", "30%"],
    correctAnswer: 2
},
{
    question: "How many birthdays does the average man have?",
    choices: ["One", "Every year"],
    correctAnswer: 0
},
{
    question: "Jack is taller than Peter, and Bill is shorter than Jack. Which of the following statements would be more accurate?",
    choices: ["It is impossible to tell whether Bill or Peter is taller", "Bill is taller than Peter", "Peter is taller than Bill", "Bill is as tall as Peter"],
    correctAnswer: 0
},
{
    question: "Which one of the five makes the best comparison? Milk is to glass as letter is to:",
    choices: ["Book", "Envelope", "Pen", "Stamp"],
    correctAnswer: 1
},
{
    question: "Some months have 31 days; how many have 28?",
    choices: ["1", "3", "6", "12"],
    correctAnswer: 3
},
{
    question: "Which number should come next in this series? 25, 24, 22, 19, 15,",
    choices: ["14", "5", "10", "30"],
    correctAnswer: 2
},
{
    question: "Which one of the five is least like the other four?",
    choices: ["Brass", "Copper", "Tin", "Lead"],
    correctAnswer: 0
},
{
    question: "SOLICITOR is to ADVISOR as SYCOPHANT is to:",
    choices: ["Blackmailer", "Flautist", "Fawner", "Nobleman"],
    correctAnswer: 2
},
{
    question: "Which one of the five is least like the other four?",
    choices: ["Potato", "Carrot", "Corn", "Apple"],
    correctAnswer: 3
},
{
    question: "Mary had several cookies. After eating one, she gave half the remainder to her sister. After eating another cookie, she gave half of what was left to her brother. Mary now had only five cookies left. How many cookies did she start with?",
    choices: ["23", "11", "22", "45"],
    correctAnswer: 0
},
{
    question: "Which one of the five makes the best comparison?   CAACCAC is to 3113313 as CACAACAC is to:",
    choices: ["31313113", "31311313", "31311131", "13133313"],
    correctAnswer: 1
}];


var currentQuestion = 0;
var viewingAns = 0;
var correctAnswers = 0;
var quizOver = false;
var iSelectedAnswer = [];
	var c=1080;
	var t;
$(document).ready(function () 
{
    // Display the first question
    displayCurrentQuestion();
    $(this).find(".quizMessage").hide();
    $(this).find(".previButton").attr('disabled', 'disabled');
	
	timerCount();
	
	$(this).find(".previButton").on("click", function () 
	{		
		
        if (!quizOver) 
		{
			if(currentQuestion == 0) { return false; }
	
			if(currentQuestion == 1) {
			  $(".previButton").attr('disabled', 'disabled');
			}
			
				currentQuestion--; // Since we have already displayed the first question on DOM ready
				if (currentQuestion < questions.length) 
				{
					displayCurrentQuestion();
					
				} 					
		} else {
			if(viewingAns == 3) { return false; }
			currentQuestion = 0; viewingAns = 3;
			viewResults();		
		}
    });

	
	// On clicking next, display the next question
    $(this).find(".nextButton").on("click", function () 
	{
        if (!quizOver) 
		{
			
            var val = $("input[type='radio']:checked").val();

            if (val == undefined) 
			{
                $(document).find(".quizMessage").text("Please select an answer");
                $(document).find(".quizMessage").show();
            } 
			else 
			{
                // TODO: Remove any message -> not sure if this is efficient to call this each time....
                $(document).find(".quizMessage").hide();
				if (val == questions[currentQuestion].correctAnswer) 
				{
					correctAnswers++;
				}
				iSelectedAnswer[currentQuestion] = val;
				
				currentQuestion++; // Since we have already displayed the first question on DOM ready
				if(currentQuestion >= 1) {
					  $('.previButton').prop("disabled", false);
				}
				if (currentQuestion < questions.length) 
				{
					displayCurrentQuestion();
					
				} 
				else 
				{
					displayScore();
					$('#iTimeShow').html('Quiz Time Completed!');
					$('#timer').html("You scored: " + correctAnswers*10 + " out of: 210");
					c=1110;
					$(document).find(".previButton").text("View Answer");
					$(document).find(".nextButton").text("Play Again?");
					quizOver = true;
					return false;
					
				}
			}
					
		}	
		else 
		{ // quiz is over and clicked the next button (which now displays 'Play Again?'
			quizOver = false; $('#iTimeShow').html('Time Remaining:'); iSelectedAnswer = [];
			$(document).find(".nextButton").text("Next Question");
			$(document).find(".previButton").text("Previous Question");
			 $(".previButton").attr('disabled', 'disabled');
			resetQuiz();
			viewingAns = 1;
			displayCurrentQuestion();
			hideScore();
		}
    });
});



function timerCount()
	{
		if(c == 1110) 
		{ 
			return false; 
		}
		
		var hours = parseInt( c / 3600 ) % 24;
		var minutes = parseInt( c / 60 ) % 60;
		var seconds = c % 60;
		var result = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds  < 10 ? "0" + seconds : seconds);            
		$('#timer').html(result);
		
		if(c == 0 )
		{
					displayScore();
					$('#iTimeShow').html('Quiz Time Completed!');
					$('#timer').html("You scored: " + correctAnswers*10 + " out of: 210");
					c=1110;
					$(document).find(".previButton").text("View Answer");
					$(document).find(".nextButton").text("Play Again?");
					quizOver = true;
					return false;
					
		}
		c = c - 1;
		t = setTimeout(function()
		{
			timerCount()
		},1000);
	}
	
	
// This displays the current question AND the choices
function displayCurrentQuestion() 
{

	if(c == 1110) { c = 1080; timerCount(); }
    //console.log("In display current Question");
    var question = questions[currentQuestion].question;
    var questionClass = $(document).find(".quizContainer > .question");
    var choiceList = $(document).find(".quizContainer > .choiceList");
    var numChoices = questions[currentQuestion].choices.length;
    // Set the questionClass text to the current question
    $(questionClass).text(question);
    // Remove all current <li> elements (if any)
    $(choiceList).find("li").remove();
    var choice;
	
	
    for (i = 0; i < numChoices; i++) 
	{
        choice = questions[currentQuestion].choices[i];
		
		if(iSelectedAnswer[currentQuestion] == i) {
			$('<li><input type="radio" class="radio-inline" checked="checked"  value=' + i + ' name="dynradio" />' +  ' ' + choice  + '</li>').appendTo(choiceList);
		} else {
			$('<li><input type="radio" class="radio-inline" value=' + i + ' name="dynradio" />' +  ' ' + choice  + '</li>').appendTo(choiceList);
		}
    }
}

function resetQuiz()
{
    currentQuestion = 0;
    correctAnswers = 0;
    hideScore();
}

function displayScore()
{
    $(document).find(".quizContainer > .result").text("You scored: " + correctAnswers*10 + " out of: 210");
    $(document).find(".quizContainer > .result").show();
}

function hideScore() 
{
    $(document).find(".result").hide();
}

// This displays the current question AND the choices
function viewResults() 
{

	if(currentQuestion == 10) { currentQuestion = 0;return false; }
	if(viewingAns == 1) { return false; }

	hideScore();
    var question = questions[currentQuestion].question;
    var questionClass = $(document).find(".quizContainer > .question");
    var choiceList = $(document).find(".quizContainer > .choiceList");
    var numChoices = questions[currentQuestion].choices.length;
    // Set the questionClass text to the current question
    $(questionClass).text(question);
    // Remove all current <li> elements (if any)
    $(choiceList).find("li").remove();
    var choice;
	
	
	for (i = 0; i < numChoices; i++) 
	{
        choice = questions[currentQuestion].choices[i];
		
		if(iSelectedAnswer[currentQuestion] == i) {
			if(questions[currentQuestion].correctAnswer == i) {
				$('<li style="border:2px solid green;margin-top:10px;"><input type="radio" class="radio-inline" checked="checked"  value=' + i + ' name="dynradio" />' +  ' ' + choice  + '</li>').appendTo(choiceList);
			} else {
				$('<li style="border:2px solid red;margin-top:10px;"><input type="radio" class="radio-inline" checked="checked"  value=' + i + ' name="dynradio" />' +  ' ' + choice  + '</li>').appendTo(choiceList);
			}
		} else {
			if(questions[currentQuestion].correctAnswer == i) {
				$('<li style="border:2px solid green;margin-top:10px;"><input type="radio" class="radio-inline" value=' + i + ' name="dynradio" />' +  ' ' + choice  + '</li>').appendTo(choiceList);
			} else {
				$('<li><input type="radio" class="radio-inline" value=' + i + ' name="dynradio" />' +  ' ' + choice  + '</li>').appendTo(choiceList);
			}
		}
    }
	
	currentQuestion++;
	
	setTimeout(function()
		{
			viewResults();
		},3000);
}
