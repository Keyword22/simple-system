<script setup lang="ts">
import { onMounted, ref } from 'vue';

const container = ref<HTMLDivElement | null>(null);
const NUM_ROWS = 8;
const NUM_COLS = 12;

// Generate grid of triangles
const shapes: any[] = [];
const TRIANGLE_SIZE = 120; // Base size of triangles

for (let row = 0; row < NUM_ROWS; row++) {
  for (let col = 0; col < NUM_COLS; col++) {
    shapes.push({
      top: `${row * TRIANGLE_SIZE - 20}px`,
      left: `${col * TRIANGLE_SIZE - 20}px`,
      isPointingUp: (row + col) % 2 === 0,
    });
  }
}

onMounted(() => {
  const handleParallax = (e: MouseEvent) => {
    if (!container.value) return;
    const shapeElements = container.value.getElementsByClassName('shape');
    const x = (window.innerWidth - e.pageX * 2) / 100;
    const y = (window.innerHeight - e.pageY * 2) / 100;
    
    Array.from(shapeElements).forEach((shape, index) => {
      const speed = (index + 1) * 0.05; // Reduced speed for smoother effect
      (shape as HTMLElement).style.transform = 
        `translate(${x * speed}px, ${y * speed}px)`;
    });
  };

  window.addEventListener('mousemove', handleParallax);
});
</script>

<template>
  <div ref="container" class="geometric-bg">
    <div
      v-for="(shape, index) in shapes"
      :key="index"
      class="shape"
      :class="{ 'triangle-up': shape.isPointingUp, 'triangle-down': !shape.isPointingUp }"
      :style="{
        top: shape.top,
        left: shape.left,
        opacity: 0.30 + (index % 3) * 0.01
      }"
    ></div>
  </div>
</template>

<style scoped>
.geometric-bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  z-index: 0;
}

.shape {
  position: absolute;
  width: 0;
  height: 0;
  transition: transform 0.2s ease-out;
}

.triangle-up {
  border-left: 60px solid transparent;
  border-right: 60px solid transparent;
  border-bottom: 104px solid rgba(96, 165, 250, 0.15);
  filter: drop-shadow(0 0 10px rgba(96, 165, 250, 0.1));
}

.triangle-down {
  border-left: 60px solid transparent;
  border-right: 60px solid transparent;
  border-top: 104px solid rgba(96, 165, 250, 0.15);
  filter: drop-shadow(0 0 10px rgba(96, 165, 250, 0.1));
}

/* Dark mode triangles */
:global(.dark) .triangle-up {
  border-bottom-color: rgba(255, 255, 255, 0.15);
  filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.05));
}

:global(.dark) .triangle-down {
  border-top-color: rgba(255, 255, 255, 0.15);
  filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.05));
}

/* Hover effects */
.triangle-up:hover {
  border-bottom-color: rgba(96, 165, 250, 0.25);
  filter: drop-shadow(0 0 15px rgba(96, 165, 250, 0.15));
}

.triangle-down:hover {
  border-top-color: rgba(96, 165, 250, 0.25);
  filter: drop-shadow(0 0 15px rgba(96, 165, 250, 0.15));
}

:global(.dark) .triangle-up:hover {
  border-bottom-color: rgba(255, 255, 255, 0.25);
  filter: drop-shadow(0 0 15px rgba(255, 255, 255, 0.1));
}

:global(.dark) .triangle-down:hover {
  border-top-color: rgba(255, 255, 255, 0.25);
  filter: drop-shadow(0 0 15px rgba(255, 255, 255, 0.1));
}
</style> 