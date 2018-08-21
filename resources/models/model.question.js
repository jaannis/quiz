import QuizAnswer from "./model.quizAnswer";

export default class Question {
    constructor() {
        /**
         *$type {?number}
         * */
        this.id = null;
        /**
         *$type {?number}
         * */
        this.quizId = null;
        /**
         *$type {string}
         * */
        this.question = '';
        /**
         *
         * @type {Array}
         */
        this.answers = [];

    }


    static fromArray(rawData) {
        let questions = new Question();
        questions.id = rawData.id;
        questions.quizId = rawData.quizId;
        questions.question = rawData.question;
        questions.answers = rawData.answers.map(QuizAnswer.fromArray);


        return questions;
    }
}