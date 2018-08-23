<template>
	<label :class="(isActive ? baseClass + ' active' : baseClass)">
		<input class="radio" type="radio" name="select" @click="onAnswerClicked">
		<span>{{ answer.answer }}</span>
	</label>
</template>

<script>
    import QuizAnswer from "../models/model.quizAnswer";

    export default {
        name: 'AnswerItem',
        data() {
            return {
                baseClass: 'list-group-item list-group-item-action'
            }
        },
        props: {
            answer: {
                type: QuizAnswer,
                required: true
            },
            onAnswered: {
                type: Function,
	            required: true
            },
            isActive: {
                type: Boolean
            }
        },
        methods: {
            onAnswerClicked() {
                this.onAnswered(this.answer.id);
            }
        }
    }
</script>