import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
	state : {
		interviewTitle: "",
		interviewDescription: "",
		interviewQuestions: ""
	},

	mutations: {
		changeInterviewState(state, data) {
			state.interviewTitle = data[0]['title'];
			state.interviewDescription = data[0]['description'];
			state.interviewQuestions = data[0]['questions']
		}
	}
})