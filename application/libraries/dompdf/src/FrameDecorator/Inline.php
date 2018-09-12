<?php
/**
 * @package dompdf
 * @link    http://dompdf.github.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @author  Helmut Tischer <htischer@weihenstephan.org>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
namespace Dompdf\FrameDecorator;

use DOMElement;
use Dompdf\Dompdf;
use Dompdf\Frame;
use Dompdf\Exception;

/**
 * Decorates frames for inline layout
 *
 * @access  private
 * @package dompdf
 */
class Inline extends AbstractFrameDecorator
{

    /**
     * Inline constructor.
     * @param Frame $frame
     * @param Dompdf $dompdf
     */
    function __construct(Frame $frame, Dompdf $dompdf)
    {
        parent::__construct($frame, $dompdf);
    }

    /**
     * @param Frame|null $frame
     * @param bool $force_pagebreak
     * @throws Exception
     */
    function split(Frame $frame = null, $force_pagebreak = false)
    {
        if (is_null($frame)) {
            $this->get_parent()->split($this, $force_pagebreak);
            return;
        }

        if ($frame->get_parent() !== $this) {
            throw new Exception("Unable to split: frame is not a child of this one.");
        }

        $node = $this->_frame->get_node();

        if ($node instanceof DOMElement && $node->hasAttribute("id")) {
            $node->setAttribute("data-dompdf-original-id", $node->getAttribute("id"));
            $node->removeAttribute("id");
        }

        $split = $this->co