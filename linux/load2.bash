#!/bin/bash

init(){
  percent=$1
  bar_count=0
  bar=""
  printf "\033[s"  # Save the cursor position
}

update(){
  bar_count=$(($bar_count + 100))
  if [ $(($bar_count % $percent)) -lt 100 ]; then
    bar="$bar#"  # Append '#' to the progress bar
  fi
  
  # Calculate the current percentage
  current_percent=$((($bar_count * 100) / (50 * 100)))
  
  # Print the progress bar within brackets, with the current percentage on the right
  printf "\033[u [%-50s] %3d%% \033[100C\n" "$bar" $current_percent
}

init 50

count=0

while [ $count -lt 50 ]; do
  sleep .05
  count=$((count + 1))
  update
done

