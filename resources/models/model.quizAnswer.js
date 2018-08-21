export default class QuizAnswer {
    constructor() {
        /**
         *$type {?number}
         * */
        this.id = null;
        /**
         *$type {string}
         * */
        this.answer = '';
        /**
         *$type {name}
         * */
        this.questionId = null;
        /**
         *$type {bool}
         * */
        this.isCorrect = null;
    }


    static fromArray(rawData) {
        let quizAnswer = new QuizAnswer();
        quizAnswer.id = rawData.id;
        quizAnswer.answer = rawData.answer;
        quizAnswer.questionId = rawData.questionId;
        quizAnswer.isCorrect = rawData.isCorrect;


        return quizAnswer;
    }
}

