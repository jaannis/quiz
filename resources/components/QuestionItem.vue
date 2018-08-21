<template>
	<div>
		<h1>
			{{ question.question }}
			<ul>
				<li v-for="answer in question.answers">
					<AnswerItem :answer="answer" :on-answered="onAnsweredPicked"></AnswerItem>
				</li>
			</ul>
			<button @click="onAnswered">Next Questions</button>
		</h1>
	</div>

</template>
<script>
    import {mapActions} from 'vuex';
    import AnswerItem from "./AnswerItem";


    export default {
        name: 'QuestionItem',
        components: {AnswerItem},
        data() {
            return {
                answerId: null,
            }
        },
        computed: {
            question: {
                get() {
                    return this.$store.state.activeQuestion;
                }
            }
        },
        methods: Object.assign({}, mapActions([
                'answer'
            ]),
            {
                onAnsweredPicked(answerId) {
                    this.answerId = answerId;
                },
                onAnswered() {
                    if (!this.answerId) {
                        alert('No answer picked');
                        return;
                    }
                    // alert(this.answerId);
                    this.answer(this.answerId);
                }
            })
    }
</script>