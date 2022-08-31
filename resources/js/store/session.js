import { createSlice } from '@reduxjs/toolkit';

const { reducer, actions } = createSlice({
  name: 'session',
  initialState: {
    user: localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')) : null,
    api_token: localStorage.getItem('api_token') ? localStorage.getItem('api_token') : null,
  },
  reducers: {
    updateUser(state, action) {
      state.user = action.payload;
      localStorage.setItem('user', JSON.stringify(state.user));
    },
    updateApiToken(state, action) {
      state.api_token = action.payload;
      localStorage.setItem('api_token', state.api_token);
    },
  },
});

export { actions as sessionActions };
export { reducer as sessionReducer };
