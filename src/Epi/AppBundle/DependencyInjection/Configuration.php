<?php
/**
 * Configuration
 *
 * PHP version 5.3.3
 *
 * @category Configuration
 * @package  Epi\AppBundle
 * @author   Mateusz Haber <mateusz.haber@uj.edu.pl>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://wierzba.wzks.uj.edu.pl/~11_haber/Question/
 */
namespace Epi\AppBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;


/**
 * Configuration
 *
 * @category Configuration
 * @package  Epi\AppBundle\DependencyInjection
 * @author   Mateusz Haber <mateusz.haber@uj.edu.pl>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://wierzba.wzks.uj.edu.pl/~11_haber/Question/
 */
class Configuration implements ConfigurationInterface
{

    /**
     * GetConfigTreeBuilider
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('epi_app');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
