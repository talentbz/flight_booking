import { createSlice } from '@reduxjs/toolkit';

const { reducer, actions } = createSlice({
  name: 'ticker',
  initialState: {
    data: [],
  },
  reducers: {
    updateData(state, action) {
      state.data = action.payload;
    },
  },
});

export { actions as tickerActions };
export { reducer as tickerReducer };
