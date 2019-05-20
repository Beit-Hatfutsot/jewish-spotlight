# Jewish Spotlight

Start the docker-compose environment:

```
docker-compose up --build
```

Site should be available at http://localhost:8080/ethiopia/he/


## Running the dataflows

The dataflows are used to manage the static data for the sites

See [environment.yaml](environment.yaml) for the required system dependencies.

To get started quickly on any modern OS you can use [Miniconda](https://conda.io/miniconda.html)

The following snippet will install Miniconda on recent Linux distributions:

```
wget https://repo.anaconda.com/miniconda/Miniconda3-latest-Linux-x86_64.sh
bash Miniconda3-latest-Linux-x86_64.sh
```

Create and activate the conda environment

```
conda env create -f environment.yaml
conda activate jewish-spotlight-dataflows
```

To update the dependencies of the active conda environment to the latest version (e.g. after a git pull):

```
conda env update -f environment.yaml
```

Install the Python package

```
python3 -m pip install -e .
```

Run the flow that generates the cache api data for ethiopia:

```
python3 flows/dump_cached_apis.py
```

The flows store data as [tabular data packages](https://frictionlessdata.io/specs/tabular-data-package/) under `data/` directory (not committed)

Run Jupyter notebooks

```
jupyter lab
```

## Deploying

Deployment is done without Docker

Initial setup and installation on the server (some modifications might be required depending on the setup):

```
JEWISH_SPOTLIGHT_DIR=/path/to/jewish-spotlight

git clone https://github.com/Beit-Hatfutsot/jewish-spotlight.git $JEWISH_SPOTLIGHT_DIR &&\
echo '#!/usr/bin/env bash' | sudo tee /usr/local/bin/jewish-spotlight-deployment.sh &&\
echo "
cd $JEWISH_SPOTLIGHT_DIR &&\\
sudo -u www-data git pull origin master &&\\
cd $JEWISH_SPOTLIGHT_DIR/bhjs-content/themes/bhjs/ &&\\
sudo -u www-data grunt
" | sudo tee -a /usr/local/bin/jewish-spotlight-deployment.sh &&\
sudo chmod +x /usr/local/bin/jewish-spotlight-deployment.sh
```

To deploy (after pushing changes to master branch):

```
ssh <SSH ARGS> -- jewish-spotlight-deployment.sh
```
