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
    }


    static fromArray(rawData) {
        let quizAnswer = new QuizAnswer();
        quizAnswer.id = rawData.id;
        quizAnswer.answer = rawData.answer;
        quizAnswer.questionId = rawData.questionId;


        return quizAnswer;
    }
}

