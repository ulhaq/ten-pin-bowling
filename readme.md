# Bowling Algorithm
**This algorithm consecutively calculates the scores of a bowling game, which follows the ten-pin bowling rulings.**

*The algorithm depends on an API with the following endpoint http://13.74.31.101/api/points*

## Installation Instructions
To install and run the algorithm follow the following steps:
1. Download the source code from this repository
2. Enter the directory which contains all the folders and files
3. Build an docker image from the Dockerfile: `docker build -t bowling .`
4. Create a docker container from the image: `docker run -p 9000:9000 bowling`
5. Access the running app: `http://localhost:9000/`

