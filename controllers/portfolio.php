<?php
class Portfolio extends Controller {
    protected function Index(){
        $viewmodel = new PortfolioModel();
        $this->ReturnView($viewmodel->index(), true);
    }

    protected function search(){
        $viewmodel = new PortfolioModel();
        $this->ReturnView($viewmodel->search(), true);
    }

    protected function portfoliopage(){
        $viewmodel = new PortfolioModel();
        $this->ReturnView($viewmodel->portfolioPage(), true);
    }

    protected function addPost(){
        $viewmodel = new PortfolioModel();
        $this->ReturnView($viewmodel->addPost(), true);
    }

    protected function editPortfolioCarousel(){
        $viewmodel = new PortfolioModel();
        $this->ReturnView($viewmodel->editPortfolioCarousel(), true);
    }
    
    protected function editPortfolioProfile(){
        $viewmodel = new PortfolioModel();
        $this->ReturnView($viewmodel->editPortfolioProfile(), true);
    }
    
    protected function editPortfolioPost(){
        $viewmodel = new PortfolioModel();
        $this->ReturnView($viewmodel->editPortfolioPost(), true);
    }

    protected function deletePortfolioPost(){
        $viewmodel = new PortfolioModel();
        $this->ReturnView($viewmodel->deletePortfolioPost(), true);
    }
}
?>