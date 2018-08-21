<template>
	<a href="#" @click="onAnsweredPicked">{{answer.answer}}</a>
</template>
<script>
    import QuizAnswer from "../models/model.quizAnswer";

    export default {
        name: 'AnswerItem',
        props: {
            answer: {
                type: QuizAnswer,
                required: true,
            },
            onAnswered: {
                type: Function,
                required: true,
            }
        },
        methods: {
            onAnsweredPicked() {
                this.onAnswered(this.answer.id);
            }
        }
    }
</script>