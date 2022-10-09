import Vue from 'vue'
import Vuex from 'vuex'

import { saveState } from './services/StateService'
import state from './state'

Vue.use(Vuex)

export const mutations = {
	setState(state, totpState) {
		state.totpState = totpState
	},
}

export const actions = {
	enable({ commit }) {
		return saveState({ state: state.STATE_CREATED }).then(
			({ state, secret, qrUrl }) => {
				commit('setState', state)
				return { qrUrl, secret }
			}
		)
	},

	confirm({ commit }, code) {
		return saveState({
			state: state.STATE_ENABLED,
			code,
		}).then(({ state }) => commit('setState', state))
	},

	disable({ commit }) {
		return saveState({ state: state.STATE_DISABLED }).then(({ state }) =>
			commit('setState', state)
		)
	},
}

export const getters = {}

export default new Vuex.Store({
	strict: process.env.NODE_ENV !== 'production',
	state: {
		totpState: undefined,
	},
	getters,
	mutations,
	actions,
})
