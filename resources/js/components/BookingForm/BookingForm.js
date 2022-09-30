import React, { useState, useEffect } from 'react';
import Radio from '@mui/material/Radio';
import RadioGroup from '@mui/material/RadioGroup';
import Box from '@mui/material/Box';
import Grid from '@mui/material/Grid';
import FormControlLabel from '@mui/material/FormControlLabel';
import FormControl from '@mui/material/FormControl';
import InputLabel from '@mui/material/InputLabel';
import MenuItem from '@mui/material/MenuItem';
import Select, { SelectChangeEvent } from '@mui/material/Select';
import dayjs from 'dayjs';
import TextField from '@mui/material/TextField';
import Stack from '@mui/material/Stack';
import { AdapterDayjs } from '@mui/x-date-pickers/AdapterDayjs';
import { LocalizationProvider } from '@mui/x-date-pickers/LocalizationProvider';
import { MobileDatePicker } from '@mui/x-date-pickers/MobileDatePicker';
import EastIcon from '@mui/icons-material/East';
import Button from '@mui/material/Button';
import Image from 'react-bootstrap/Image';
import plan from '../../../images/frontend/search_icon.png';
import './BookingForm.scss';

import { divide } from 'lodash';

function BookingForm(){
  const [fromAddress, setFromAddress] = React.useState('');
  const [toAddress, setToAddress] = React.useState('');
  const [departure, setDeparture] = React.useState(dayjs());
  const [returnValue, setReturnValue] = React.useState(dayjs());

  
  const handleFromAddress = (event) => {
    setFromAddress(event.target.value);
  };
  const handleToAddress = (event) => {
    setToAddress(event.target.value);
  };
    return (
    <Box>
        <div className='flight-image'>
          <Image className="logo" src={plan} />
          <span>Flights</span> 
        </div>
        <Box>
          <RadioGroup row name="row-radio-buttons-group">
            <FormControlLabel value="female" control={<Radio />} label="Round Trip" />
            <FormControlLabel value="male" control={<Radio />} label="Outbound" />
            <FormControlLabel value="other" control={<Radio />} label="Inbound" />
          </RadioGroup>
        </Box>
        <Grid container sx={{ marginTop: 2, }}>
          <Grid item xs={6}>
            <FormControl sx={{ width: '200px', marginRight: 2, }}>
              <InputLabel id="demo-simple-select-label">From</InputLabel>
                <Select
                  labelId="demo-simple-select-label"
                  id="demo-simple-select"
                  value={fromAddress}
                  label="From"
                  onChange={handleFromAddress} >
                  <MenuItem value={'acra'}>Acra</MenuItem>
                </Select>
            </FormControl>
            <FormControl sx={{ width: '200px' }}>
              <InputLabel id="demo-simple-select-label">To</InputLabel>
                <Select
                  labelId="demo-simple-select-label"
                  id="demo-simple-select"
                  value={toAddress}
                  label="To"
                  onChange={handleToAddress} >
                  <MenuItem value={'london'}>London</MenuItem>
                </Select>
            </FormControl>
          </Grid>
          <Grid container spacing={2} xs={6}>
            <Grid item xs={6}>
              <LocalizationProvider dateAdapter={AdapterDayjs}>
                  <Stack spacing={3}>
                    <MobileDatePicker
                      label="Departure"
                      value={departure}
                      onChange={(newValue) => {
                        setDeparture(newValue);
                      }}
                      renderInput={(params) => <TextField {...params} />}
                    />
                  </Stack>
                </LocalizationProvider>
            </Grid>
            <Grid item xs={6}>
              <LocalizationProvider dateAdapter={AdapterDayjs}>
                  <Stack spacing={3}>
                    <MobileDatePicker
                      label="Return"
                      value={returnValue}
                      onChange={(newValue) => {
                        setReturnValue(newValue);
                      }}
                      renderInput={(params) => <TextField {...params} />}
                    />
                  </Stack>
                </LocalizationProvider>
            </Grid>
          </Grid>
        </Grid>
        <div className='search-flight'>
          <Button variant="contained" size="large" endIcon={<EastIcon />}>Search Flight</Button>
        </div>
    </Box>
    );
}
export default BookingForm;