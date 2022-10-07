import React, { useState, useEffect } from 'react';
import { Box, Tooltip } from "@mui/material";

const ImageAvatar = ({ onChange, disabled = false }) => {
    const [preview, setPreview] = React.useState(null);
  
    const handleChange = (e) => {
      const file = e.target.files[0];
      if (file) {
        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function () {
          setPreview(reader.result);
          onChange(file);
        };
        reader.onerror = function (error) {
          console.log("Error: ", error);
        };
      } else {
        setPreview(null);
        onChange(null);
      }
    };
  
    return (
      <Box>
        <Tooltip
          title={
            <>
              Upload Photo
              <br />
              min: 150px x 150px
            </>
          }
          arrow
          placement="bottom"
          sx={{
            textAlign: "center",
            cursor: "pointer",
          }}
        >
          <Box
            component="label"
            sx={{
              display: "flex",
              width: 100,
              height: 100,
              alignItems: "center",
              justifyContent: "center",
              background: "#ccc",
              borderRadius: "50%",
              overflow: "hidden",
              cursor: "pointer",
              userSelect: "none",
            }}
          >
            <Box
              disabled={disabled}
              component="input"
              accept="image/*"
              type="file"
              onChange={handleChange}
              sx={{ display: "none" }}
            />
            {preview && <Box component="img" src={preview} sx={{ width: 1, height: 1, objectFit: "cover" }} />}
            {!preview && <Box sx={{ color: "#fff", fontSize: 36 }}>DD</Box>}
          </Box>
        </Tooltip>
      </Box>
    );
  };
  
  export default ImageAvatar;